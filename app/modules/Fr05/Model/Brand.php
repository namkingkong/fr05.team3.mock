<?php
namespace Fr05\Model;

class Brand extends BaseModel {
	
	protected $table = 'brand';
	
	public function getRules() {
		return [ 
				'default' => [ 
						'name' => "required | unique:brand,name,$this->id"
				]
		];
	}
	
	public function products() {
		return $this->hasMany(Product::class);
	}
}
