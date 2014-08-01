<?php
namespace Fr05\Admin\Controller;

use Fr05\Service\ReviewService;
use Illuminate\Support\Facades\View;
use Fr05\Service\ProductService;
use Fr05\Model\Product;
use Fr05\Model\Review;

class ReviewController extends \BaseController {
	
	public function getIndex(){
		$data = ReviewService::getAll();
		
		foreach ($data as $key => $review){
			$product = ProductService::getById($review->product_id);
			
			$data[$key]['product_name'] = $product ? $product->name : null; 
		}
		return View::make(VIEW_ADMIN. '::review.list') -> with ('reviewsList',$data)->with('enablePagination',true);
	}
	
	public function getEdit($id){
		$data['review'] = Review::find($id);
		$data['product_name'] = Product::find($data['review']->product_id)->name;
		return View::make(VIEW_ADMIN. '::review.edit', $data);
	}
}