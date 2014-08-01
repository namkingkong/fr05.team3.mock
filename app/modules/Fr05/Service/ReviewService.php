<?php
namespace Fr05\Service;

use Fr05\Model\Review;
use Fr05\Helper\Config;

class ReviewService{

	public static function getAverageRating($id){
		$average = Review::where('product_id', $id)->avg('rating');
		
		return  $average;
	}
	
	public static function getAll(){
		return Review::orderBy('id','DESC')->paginate(Config::get('row_per_page'));
	}
	public static function get($id){
		return Review::find($id);
	}
	
	public static function approve($id){
		$review = Review::find($id);
		$review->isApproved = 1;
		$review->save();
	}
	
	public static function delete($id){
		Review::where('id',$id) ->delete();
	}
}