<?php
namespace Fr05\Model;

class Category extends BaseModel {
	
	protected $table = 'category';
	
	
	/**
	 * @see \Fr05\Model\BaseModel::getRules()
	 */
	public function getRules() {
		return [ 
				'default' => [ 
						'name' => "required | unique:category,name,$this->id",
						'parent_id' => 'numeric | exists:category,id' 
				]
		];
	}

	
	public function products() {
		return $this->belongsToMany(Product::class, 'product_category');
	}
	
	public function parent() {
		return $this->belongsTo(Category::class, 'parent_id');
	}
	
	public function children() {
		return $this->hasMany(Category::class, 'parent_id');
	}
		
}