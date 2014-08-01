<?php
namespace Fr05\Model;

class Comment extends BaseModel {
	
	protected $table = 'comment';

	public function getRules() {
		return [
				'default' => [],
				];
	}
	
	public $timestamps = true;
	
	/**
	 * Disable only UPDATED_AT field
	 *
	 * @return multitype:string
	 */
	public function setUpdatedAt($value)
	{
	    // Do nothing.
	}
	
	public function getProduct() {
		return $this->belongsTo(Product::class);
	}
	
	public function getUser() {
		return $this->belongsTo(\User::class);
	}
	
}
