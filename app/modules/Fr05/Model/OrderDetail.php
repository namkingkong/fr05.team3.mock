<?php
namespace Fr05\Model;

class OrderDetail extends BaseModel {
	
	protected $table = 'order_detail';
	
	public function getRules() {
		return [
				'default' => [],
		];
	}
	
	/**
	 * The Order this Order Detail belongs to
	 */
	public function order() {
		return $this->belongsTo(Order::class);
	}
	
	/**
	 * The Product this Order Detail belongs to
	 */
	public function product() {
		return $this->belongsTo(Product::class);
	}
	
	public function user(){
		return $this->belongsTo(User::class);
	}
	
}

