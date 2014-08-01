<?php
namespace Fr05\Service;

use Fr05\Model\Product;
use Illuminate\Support\Facades\DB;
use Fr05\Exception\EntityNotFoundException;

class ProductService {
	
	public static function getAll() {
		return Product::all();
	}
	
	public static function getById($id) {
		return Product::find($id);
	}

	public static function save(Product $object) {
		return $object->save();
	}
	
	public static function delete($id) {

		$product = Product::find($id);
		
		if ($product === null) {
			throw new EntityNotFoundException('Product not found');
		}
		
		$result = 0;
		
		DB::transaction(function() use (&$product, &$result) {
			// Delete Banner before delete Product
			if ($product->banner) {
				$product->banner->delete();
			}
			
			$result = $product->delete();
		});
		
		return $result;
	}
	
	public static function getLargestIndex() {
		$query = Product::orderBy('index', 'desc')
				->first();
		
		if ($query == null) {
			return 1;
		}
		
		return $query->index;
	}
	
	public static function getAllWithDetails($brand_id,$lowest_price,$highest_price,$sort_field,$sort_direction,$numPerPage){
		if ($brand_id){
			return Product::with(array('brand','images' => function($query){
				$query->where('isMainImage',1);
			}))
			->whereIn('brand_id',$brand_id)
			->whereBetween('list_price',[$lowest_price,$highest_price])
			->orderBy($sort_field,$sort_direction)
			->paginate($numPerPage);
		}
		else{
			return Product::with(array('brand','images' => function($query){
				$query->where('isMainImage',1);
			}))
			->whereBetween('list_price',[$lowest_price,$highest_price])
			->orderBy($sort_field,$sort_direction)
			->paginate($numPerPage);
		}
	}
	
	public static function getDetailsForMany($array,$brand_id,$lowest_price,$highest_price,$sort_field,$sort_direction,$numPerPage){
		if ($brand_id){
			return Product::with(array('brand','images' => function($query){
				$query->where('isMainImage',1);
			}))
			->whereIn('id',$array)
			->whereIn('brand_id',$brand_id)
			->whereBetween('list_price',[$lowest_price,$highest_price])
			->orderBy($sort_field,$sort_direction)
			->paginate($numPerPage);
		}
		else{
			return Product::with(array('brand','images' => function($query){
				$query->where('isMainImage',1);
			}))
			->whereIn('id',$array)
			->whereBetween('list_price',[$lowest_price,$highest_price])
			->orderBy($sort_field,$sort_direction)
			->paginate($numPerPage);
		}
	}
	
	public static function getPrice($direction,$category_id=0,$brand_id=[]) {
		$dir = ($direction=='highest')? 'desc' : 'asc';
		if($category_id==0){
			if ($brand_id){
				$highestPriceProduct = Product::select('list_price')
				->orderBy('list_price', $dir)
				->whereIn('brand_id',$brand_id)
				->first();
			} else{
				$highestPriceProduct = Product::select('list_price')
				->orderBy('list_price', $dir)
				->first();
			}
		} else {
			$products_id = ProductCategoryService::getProductIdByCategoryId($category_id);
			
			$array = array();
			
			foreach ($products_id as $key => $value) {
				$array[] = $value->product_id;
			}
			
			if($brand_id){
				$highestPriceProduct = Product::select('list_price')
				->orderBy('list_price', $dir)
				->whereIn('id',$array)
				->whereIn('brand_id',$brand_id)
				->first(); 
			} else{
				$highestPriceProduct = Product::select('list_price')
				->orderBy('list_price', $dir)
				->whereIn('id',$array)
				->first();
			}
		}
		
				
		return $highestPriceProduct ? $highestPriceProduct->list_price : 0;
	}
	
	public static function getLatestProduct($quantity) {
		return Product::with (array (
					'brand',
					'images' => function ($query) {
						$query->where ( 'isMainImage', 1 );
					}
				))
				->orderBy('id', 'desc')
				->take ( $quantity )
				->get ();
	}
	
}
