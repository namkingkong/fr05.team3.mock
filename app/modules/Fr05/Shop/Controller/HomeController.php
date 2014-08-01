<?php
namespace Fr05\Shop\Controller;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Fr05\Service\ProductService;
use Fr05\Service\ProductCategoryService;
use Fr05\Service\CategoryService;
use Fr05\Model\Category;
use Fr05\Model\Review;
use Fr05\Service\CartService;
use Illuminate\Support\Facades\Redirect;
use Fr05\Model\Order;
use Fr05\Service\OrderService;
use Fr05\Helper\Config;

class HomeController extends \BaseController {
	
	public function getIndex() {
		return View::make(VIEW_SHOP . '::index');
	}
	
	public function getSearch() {
		$categories = CategoryService::getAll();
		return View::make(VIEW_SHOP . '::search')->with('categories',$categories);
	}
	
	public function getProducts(){
		$categories = CategoryService::getAll();
		return View::make(VIEW_SHOP.'::listProduct')->with('categories',$categories);
	}		

	public function getGet(){		
		$category_id = Input::get('category_id')? Input::get('category_id') : 0;
		$brand_id = Input::get('brand_id')? Input::get('brand_id') : [] ; 
		$lowest_price = Input::get('lowest_price')? Input::get('lowest_price') : 0;
		$highest_price = Input::get('highest_price') ? Input::get('highest_price'): 100000000;
		$sort_field = Input::get('sort_field') ? Input::get('sort_field') : 'name';
		$sort_direction = Input::get('sort_direction')? Input::get('sort_direction'): 'desc' ;
		$page = Input::get('page')? Input::get('page') : 1;
		$numPerPage = Config::get('product_per_page');
	
		if ($category_id == 0){
			$products = ProductService::getAllWithDetails($brand_id,$lowest_price,$highest_price,$sort_field,$sort_direction,$numPerPage);
		}
		else {
			$products_id = ProductCategoryService::getProductIdByCategoryId($category_id);
				
			$array = array();
				
			foreach ($products_id as $key => $value) {
				$array[] = $value->product_id;
			}
				
			$products = ProductService::getDetailsForMany($array,$brand_id,$lowest_price,$highest_price,$sort_field,$sort_direction,$numPerPage);
				
		}
		return Response::json([
				'status' => true,
				'data' => $products->toArray(),
				
		]);
	}
	
	public function getProductdetail($proId) {
		$product = ProductService::getById ( $proId );
		return View::make ( VIEW_SHOP . ('::productDetail') )->with ( 'product', $product );
	}
	
	public function postProductdetail() {
		$input = Input::get('input');
		
		$validator = Validator::make(
				$input,
				array(
					'name' => 'required',
					'email'=> 'required|email',
					'content' => 'required'
				)
		);
		if(!$validator->fails()) {
			$review = new Review();
			$review->name = $input['name'];
			$review->email = $input['email'];
			$review->product_id = $input['product_id'];
			$review->rating = $input['score'];
			$review->review = $input['content'];
			$review->created_at = date("Y-m-d H:i:s");
			$review->save();
			return \Redirect::to("/productdetail/".$input['product_id'])->with('successAlert',"Your review is pending to be approved by admin");
		} else {
			return $this->getProductdetail($input['product_id'])->withErrors($validator);
		}
	}	

	public function getCart() {
		return View::make(VIEW_SHOP . '::cart')->with('cart', CartService::getAll());
	}
	
	public function postCart() {
		
		$cartInput = Input::get('cart');
		
		// Validate Input
		if (! count($cartInput)) {
			return Redirect::to('cart');
		}
		
		// Check if any quantity is LESSER THAN 1
		foreach ($cartInput as $quantity) {
			if ($quantity < 1) {
				return Redirect::to('cart');
			}
		}
		
		// Clear Cart
		CartService::clear();
		
		// Add the final collection of Product to Cart
		foreach ($cartInput as $productId => $quantity) {
			$product = ProductService::getById($productId);
			
			if ($product !== null) {
				CartService::set($product, $quantity);
			}
		}
		
		// Redirect to Checkout page
		return Redirect::to('/checkout');
	}
	
	public function getCheckout() {
		// Check if Cart is EMPTY
		if (CartService::isEmpty()) {
			return Redirect::to('cart');
		}
		
		return View::make(VIEW_SHOP . '::checkout')->with('cart', CartService::getAll());
	}
	
	public function postCheckout() {
		// Create new Order object with Customer Info
		$order = new Order(Input::get('customer'));
		
		// Validate
		{
			$orderValidator = $order->validate();
			
			if ($orderValidator->fails()) {
				return Redirect::to('checkout')->withErrors($orderValidator)->withInput();
			}
		}
		
		// Insert new Order with Customer Info and Cart Items
		$result = OrderService::insert($order);
		
		
		// Clear Cart after successfully inserting new Order
		CartService::clear();
		
		return Redirect::to('cart');
	}
	
	public function getPrice(){
		$category_id = Input::get('category_id')? Input::get('category_id') : 0;
		$brand_id = Input::get('brand_id')? Input::get('brand_id') : [] ; 
		
		$highestPrice = ProductService::getPrice('highest',$category_id,$brand_id);
		$lowestPrice = ProductService::getPrice('lowest',$category_id,$brand_id);
		$data = [
			'status' => true,
			'highestPrice' =>$highestPrice,
			'lowestPrice' => $lowestPrice
		];
		
		return Response::json($data);
	}
}
