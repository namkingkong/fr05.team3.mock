<?php
namespace Fr05\AjaxWebService\Controller;

use Fr05\Helper\Cart;
use Fr05\Service\CartService;
use Fr05\Model\Product;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Input;

class CartAjaxController extends \BaseController {
	
	public function getSet() {
		$productId = Input::get('product_id');
		
		// Check Product's existence in Cart
		if (CartService::has($productId)) {
			return Response::json([
					'status' => false,
					'message' => 'This product is already in your cart',
					'totalQuantity' => CartService::getTotalQuantity()
			]);
		}
		
		$product = Product::find($productId);
		
		// Check Product's existence
		if (! $product) {
			return Response::json([
					'status' => false,
					'message' => 'Product not found',
					'totalQuantity' => CartService::getTotalQuantity()
			]);
		}
		
		$quantity = 1;

		CartService::set($product, $quantity);
		
		return Response::json([
				'status' => true,
				'message' => 'Product inserted into Cart',
				'totalQuantity' => CartService::getTotalQuantity()
		]);
	}
	
	public function getRemove() {
		$productId = Input::get('product_id');
		
		CartService::remove($productId);
		
		return Response::json([
				'status' => true,
				'message' => 'Product removed from Cart',
				'totalQuantity' => CartService::getTotalQuantity()
		]);
	}
	
	public function getAll() {
		return Response::json([
				'status' => true,
				'data' => CartService::getAll()
		]);
	}
	
	public function getClear() {
		CartService::clear();
		
		return Response::json([
				'status' => true,
				'message' => 'Cart cleared'
		]);
	}
	
	public function getTotalQuantity() {
		return Response::json([
				'status' => true,
				'data' => CartService::getTotalQuantity()
		]);
	}
	
}
