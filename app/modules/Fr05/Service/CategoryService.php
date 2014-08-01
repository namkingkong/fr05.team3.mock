<?php
namespace Fr05\Service;

use Fr05\Model\Category;
use Illuminate\Support\Facades\DB;

class CategoryService {
	
	public static function getAll() {
		return Category::all();
	}
	
	public static function getAllExcept($ids) {
		return Category::whereNotIn('id', $ids)->get();
	}

	public static function getAllTopLevel() {
		return Category::where('parent_id', null)->get();
	}
	
	public static function getById($id) {
		return Category::find($id);
	}

	public static function save(Category $object) {
		/*
		 * If the index field is not currently set yet,
		 * set it to be the largest index in the children
		 * list of the same parent
		 */
		if (! $object->index) {
			// Get the currently largest index in the list of the same parent
			$lastCategory = Category::where('parent_id', $object->parent_id)
									->orderBy('index', 'desc')
									->first();
			
			// Get the index from the last category, or set to 0 if there is no children found
			$lastIndex = $lastCategory ? $lastCategory->index : 0;
			
			$object->index = $lastIndex + 1;
		}
		
		/**
		 * Setup category level
		 */
		if ($object->parent) {
			$object->level = $object->parent->level + 1;
		}
		else {
			$object->level = 1;
		}
		
		return $object->save();
	}
	
	public static function saveMany($objects) {
		/*
		 * Because this operation may affects more than 1 record,
		 * we have to execute it in a transaction to protect
		 * the data's consistency
		 */
		DB::transaction(function() use ($objects) {
			foreach ($objects as $object) {
				static::save($object);
			}
		});
	}
	
	public static function delete($id) {
		return Category::destroy($id);
	}
	
	public static function getAllFirstLevelChildren($id,&$children = array()) {
		$cate = Category::find($id);
		return $cate->children;
	}
	
	/**
	 * Get all parent from all levels
	 * 
	 * @param unknown $id
	 * @param unknown $parents
	 * @return unknown
	 */
	public static function getAllParent($id){
		$cate = Category::find($id);
		
		$parents = [];
		
		while ($cate->parent != null) {
			$parents[] = $cate->parent;
			$cate = $cate->parent;
		}
		
		return $parents;
	}
	
	public static function getAllChildren($id){
		
		$cate = Category::find($id);
		
		$allChildren[] = $cate;
		
		if ($cate->children->count() > 0){
			foreach ($cate->children as $child){
				$allChildren = array_merge($allChildren, static::getAllChildren($child->id));
			}
		}
		
		return $allChildren;
	}
	
}
