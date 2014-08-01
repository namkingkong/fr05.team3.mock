<?php
namespace Fr05\Helper;

class Cart {
	
	protected $collection = [];
	
	public function set($product, $quantity) {
		$this->collection[$product->id] = [
			'product' => $product,
			'quantity' => $quantity
		];
	}
	
	public function get($productId) {
		return $this->collection[$productId];
	}
	
	public function remove($productId) {
		unset($this->collection[$productId]);
	}
	
	public function all() {
		return $this->collection;
	}
	
}
