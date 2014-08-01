<?php
namespace Fr05\Service;

use Fr05\Model\ProductCategory;

class ProductCategoryService {
	
	public static function getProductIdByCategoryId($category_id){
		return ProductCategory::select('product_id')->where('category_id',$category_id)->get();
	}
}