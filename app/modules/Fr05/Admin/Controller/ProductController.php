<?php

namespace Fr05\Admin\Controller;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Fr05\Model\Product;
use Fr05\Service\BrandService;
use Fr05\Service\CategoryService;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Fr05\Service\UserService;
use Fr05\Service\ProductService;
use Fr05\Model\Category;
use Fr05\Model\Image;
use Fr05\Service\ImageService;
use Fr05\Model\Brand;
use Illuminate\Support\Collection;
use Fr05\Helper\Config;
use Illuminate\Support\Facades\Response;
use Fr05\Service\BannerService;

class ProductController extends Controller {
	
	public function getIndex() {
		$productList = Product::paginate(Config::get('row_per_page'));
		$banners = BannerService::getAll ();
		
		$keyword = Input::get('keyword');
		if($keyword) {
			$productList = Product::where('name','Like','%'.$keyword.'%')->paginate(Config::get('row_per_page'))->appends(array('keyword'=>$keyword));
			return View::make(VIEW_ADMIN .'::product.list')->with('productList',$productList)->with('keyword',$keyword)->with('banners', $banners);
		}
		return View::make ( VIEW_ADMIN . '::product.list' )->with('productList',$productList)->with('paginationEnable','true')->with('banners', $banners);
	}
	
	public function postIndex() {
		
		//echo $keyword;

	
	}
	public function getCreate() {
		$brands = new Collection([new Brand(['id' => null, 'name' => '-----------'])]);
		$brands = $brands->merge(Brand::all());
		$data['brands'] = $brands;
		
		$topCategories = CategoryService::getAllTopLevel ();
		
		$categories = [];
		foreach($topCategories as $topCategory){
			$categories = array_merge($categories,CategoryService::getAllChildren($topCategory->id));
		}
		
		$data ['categories'] = $categories;
		
		return View::make ( VIEW_ADMIN . '::product.form', $data );
	}
	
	public function postImage(){
		
		$product_id = Input::get('product_id');
		
		$product = Product::find($product_id);
		/*
		 * Images...
		*/
		if (Input::hasFile ( 'images' )) {
			$images = Input::file ( 'images' );
			$images = array_slice ( $images, 0, (10-$product->images->count()) );
		} else {
			$images = [ ];
		}
		
		/*
		 * Validate images
		 */
	
		foreach ( $images as $image ) {;
		
			$validatorImage = ImageService::validate($image, ['image' => 'mimes:png,jpeg,jpg']);
				
			if ($validatorImage->fails()) {
				return Redirect::action ( ProductController::class . '@getUpdate',$product->id )->withInput ()->withErrors ( $validatorImage );
			}
		}

		
		
		DB::transaction ( function () use($product, $images) {
			foreach ( $images as $image ) {
				// Insert the current image into DB
				(new Image ( [
						'path' => $image->getClientOriginalName (),
						'isMainImage' => false,
						'product_id' => $product->id
						] ))->save ();
					
				// Save the current image
				$destinationPath = "public/img/product/$product->id";
				$image->move ( $destinationPath, $image->getClientOriginalName () );
			}
		} );
		
		return Redirect::action ( ProductController::class . '@getUpdate', $product->id );
	}
	
	public function postCreate() {
		$productInput = Input::get ( 'product' );
		$categoryIds = Input::get ( 'category_id' );
		
		if (empty ( $categoryIds )) {
			$categoryIds = [ ];
		}
		
		// Check if Product's Brand ID is an EMPTY STRING
		if (empty ( $productInput ['brand_id'] )) {
			$productInput ['brand_id'] = null;
		}
		
		/*
		 * Category...
		 */
		$categories = [ ];
		
		foreach ( $categoryIds as $categoryId ) {
			$categories [] = Category::find ( $categoryId );
		}
		
		/*
		 * Images...
		 */
		if (Input::hasFile ( 'images' )) {
			$images = Input::file ( 'images' );
			// Keep only the first 10 images
			$images = array_slice ( $images, 0, 10 );
		} else {
			$images = [ ];
		}
		
		/*
		 * Product
		 */
		$product = new Product ( $productInput );
		
		$validator = $product->validate ();
		
		foreach ( $images as $image ) {;

			$validatorImage = ImageService::validate($image, ['image' => 'mimes:png,jpeg,jpg']);
			
			if ($validatorImage->fails()) {
				return Redirect::action ( ProductController::class . '@getCreate' )->withInput ()->withErrors ( $validatorImage );
			}
		}
		
		if ($validator->fails ()) {
			// Redirect
			return Redirect::action ( ProductController::class . '@getCreate' )->withInput ()->withErrors ( $validator );
		} else {
			
			DB::transaction ( function () use($product, $categoryIds, $categories, $images) {
				
				$largestIndex = ProductService::getLargestIndex ();
				
				$product->index = $largestIndex ? $largestIndex + 1 : 1;
				
				ProductService::save ( $product );
				
				foreach ( $categories as $category ) {
					
					$parents = CategoryService::getAllParent ( $category->id );
					
					foreach ( $parents as $parent ) {
						$categoryIds [] = $parent->id;
					}
					
					array_unique ( $categoryIds );
				}
				
				$product->categories ()->sync ( $categoryIds );
				
				$isMainImage = true;
				
				foreach ( $images as $image ) {
					// Insert the current image into DB
					(new Image ( [ 
							'path' => $image->getClientOriginalName (),
							'isMainImage' => $isMainImage,
							'product_id' => $product->id 
					] ))->save ();
					
					$isMainImage = false;
					
					// Save the current image
					$destinationPath = "public/img/product/$product->id";
					$image->move ( $destinationPath, $image->getClientOriginalName () );
				}
			} );
			
			return Redirect::action ( ProductController::class . '@getIndex' );
		}
	}
	
	public function getUpdate($id) {
		$data['product'] = Product::find($id);
		
		$brands = new Collection([new Brand(['id' => null, 'name' => '-----------'])]);
		$brands = $brands->merge(Brand::all());
		$data['brands'] = $brands;
		
		$topCategories = CategoryService::getAllTopLevel ();
		
		$categories = [];
		foreach($topCategories as $topCategory){
			$categories = array_merge($categories,CategoryService::getAllChildren($topCategory->id));
		}
		
		$data ['categories'] = $categories;
		return View::make(VIEW_ADMIN . '::product.update', $data);
	}
	
	public function postUpdate($id){
		$productInput = Input::get ( 'product' );
		
		$categoryIds = Input::get ( 'category_id' );
		
		if (empty ( $categoryIds )) {
			$categoryIds = [ ];
		}
		
		// Check if Product's Brand ID is an EMPTY STRING
		if (empty ( $productInput ['brand_id'] )) {
			$productInput ['brand_id'] = null;
		}
		
		/*
		 * Category...
		 */
		$categories = [ ];
		
		foreach ( $categoryIds as $categoryId ) {
			$categories [] = Category::find ( $categoryId );
		}
		
		$product = ProductService::getById($id);
		$product->fill($productInput);
		
		$validator = $product->validate ();
		
		if ($validator->fails ()) {
			// Redirect
			return Redirect::action (ProductController::class . '@getUpdate', $product->id)->withInput ()->withErrors ( $validator );
		} else {
				
			DB::transaction ( function () use($product, $categoryIds, $categories) {
		
				$largestIndex = ProductService::getLargestIndex ();
		
				ProductService::save ( $product );
				
				foreach ( $categories as $category ) {
					
					$parents = CategoryService::getAllParent ( $category->id );
					
					foreach ( $parents as $parent ) {
						$categoryIds [] = $parent->id;
					}
					
					array_unique ( $categoryIds );
				}
				
				$product->categories ()->sync ( $categoryIds );
			} );
			
			return Redirect::action ( ProductController::class . '@getIndex' );
		}
	}
	
	/*
	 * Product getDelete
	 */
	public function deleteDelete($id) {
		if (is_numeric ($id)) {
			
			// Delete Product
			$product = Product::find ( $id );
			
			if ($product == null) {
				return "Product ID $id not found";
			}
			
			$result = ProductService::delete($id);
				
			// Redirection
			if ($result > 0) {
				$data = [ 
						'status' => true,
						'message' => 'Deleted'
				];
			}
			else {
				$data = [
						'status' => false,
						'message' => 'Nothing is deleted'
				];
			}
				
		} else {
			$data = [ 
					'status' => false,
					'message' => "Something has gone wrong!" 
			];
		}
		
		return Response::json($data);
	}
	
	
}
