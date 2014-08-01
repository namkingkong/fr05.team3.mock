<?php
namespace Fr05\Service;

use Fr05\Model\Brand;

class BrandService {
	
	public static function getAll() {
		return Brand::all();
	}
	
	public static function getById($id) {
		return Brand::find($id);
	}

	public static function save(Brand $object) {
		return $object->save();
	}
	
	public static function delete($id) {
		return Brand::destroy($id);
	}
}
