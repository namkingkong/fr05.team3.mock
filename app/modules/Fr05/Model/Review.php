<?php
namespace Fr05\Model;

class Review extends BaseModel {
	
	protected $table = 'review';
	
	public $timestamps = false;
	
	/**
	 * Disable only UPDATED_AT field
	 *
	 * @return multitype:string
	 */
	public function setUpdatedAt($value)
	{
	    // Do nothing.
	}
	
	public function getRules() {
		return [
				'default' => [],
		];
	}
	
	/**
	 * User this Review belongs to
	 */
	public function user() {
		return $this->belongsTo(\User::class);
	}
	
	/**
	 * Product this Review belongs to
	 */
	public function product() {
		return $this->belongsTo(Product::class);
	}
	
}
