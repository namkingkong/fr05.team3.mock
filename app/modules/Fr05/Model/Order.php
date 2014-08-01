<?php
namespace Fr05\Model;

class Order extends BaseModel {
	
	protected $table = 'order';
	
	public function getRules() {
		return [ 
				'default' => [ 
						'customer_name' => 'required',
						'customer_email' => 'required | email',
						'customer_phone' => 'required | numeric',
						'customer_address' => 'required'
				] 
		];
	}
	
	public function user() {
		return $this->belongsTo(\User::class);
	}
	
	public function orderDetails() {
		return $this->hasMany(OrderDetail::class);
	}
	
}
