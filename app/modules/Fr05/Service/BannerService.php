<?php
namespace Fr05\Service;

use Fr05\Model\Banner;
use Illuminate\Support\Facades\DB;

class BannerService {
	
	public static function getAll() {
		return Banner::orderBy('index')->get();
	}
	
	public static function getById($id){
		return Banner::find($id);
	}
	
	public static function getLargestIndex() {
		$lastBanner = Banner::orderBy('index', 'desc')->first();
		
		if ($lastBanner) {
			return $lastBanner->index;
		}
		
		return 0;
	}
	
	public static function save(Banner $object){
		if(!$object->index){
			$lastIndex = static::getLargestIndex();
			
			$object->index = $lastIndex + 1;
		}
		
		return $object->save();
	}
	
	public static function saveMany($objects){
		DB::transaction(function() use ($objects) {
			foreach ($objects as $object) {
				static::save($object);
			}
		});
	}
	
	public static function delete($id){
		return Banner::destroy($id);
	}
}