<?php
namespace Fr05\Service;

use Fr05\Model\Product;
use Fr05\Helper\Cart;
use Illuminate\Support\Facades\Session;

class CartService {
	
	const SESSION_CART_KEY = '__CART__';
	
	protected static function loadSession() {
		if(!isset($_SESSION)){
		    session_start();
		}
		
		if (! isset($_SESSION[static::SESSION_CART_KEY])) {
			$_SESSION[static::SESSION_CART_KEY] = [];
		}
	}
	
	public static function set($product, $quantity) {
		static::loadSession();
		
		$cart = & $_SESSION[static::SESSION_CART_KEY];
		
		$cart[$product->id] = [
			'product' => $product,
			'quantity' => $quantity
		];
	}
	
	public static function remove($productId) {
		static::loadSession();
		
		$cart = & $_SESSION[static::SESSION_CART_KEY];
		
		unset($cart[$productId]);
	}
	
	public static function clear() {
		static::loadSession();
		
		unset($_SESSION[static::SESSION_CART_KEY]);
	}

	public static function get($productId) {
		static::loadSession();
		
		$cart = $_SESSION[static::SESSION_CART_KEY];
		
		return isset($cart[$productId]) ? $cart[$productId] : null;
	}
	
	public static function getAll() {
		static::loadSession();
		
		return $_SESSION[static::SESSION_CART_KEY];
	}
	
	public static function getTotalQuantity() {
		$quantity = 0;
		
		foreach (CartService::getAll() as $item) {
			$quantity += $item['quantity'];
		}
		
		return $quantity;
	}
	
	public static function has($productId) {
		static::loadSession();
		return isset($_SESSION[static::SESSION_CART_KEY][$productId]);
	}
	
	public static function isEmpty() {
		static::loadSession();
		
		return empty($_SESSION[static::SESSION_CART_KEY]);
	}
}
