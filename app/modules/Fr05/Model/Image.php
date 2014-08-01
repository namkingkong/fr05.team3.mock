<?php
namespace Fr05\Model;

class Image extends BaseModel {
	
	protected $table = 'image';
	
	
	/**
	 * The Product this Image belongs to
	 */
	public function product() {
		return $this->belongsTo(Product::class);
	}
	
}
