<?php
namespace Fr05\Model;

class Banner extends BaseModel {
	
	protected $table = 'banner';
	
	public function getRules() {
		return [
				'default' => [
					'product_id' => "required | unique:banner,product_id,$this->id"
				]
		];
	}
	
	/**
	 * The Product this Banner belongs to
	 */
	public function product() {
		return $this->belongsTo(Product::class);
	}
	
}
