<?php
namespace Fr05\AjaxWebService\Controller;

use Illuminate\Support\Facades\Response;
use Fr05\Service\ReviewService;
use Fr05\Model\Review;

class ReviewAjaxController extends \BaseController{
	
	public function getApprove($id){
		if (is_numeric($id)){
			ReviewService::approve($id);
				$data = [
						'status' => true,
						'message' => "Approved!"
						];
		} else { 
			$data = [
				'status' => false,
				'message' => "Wrong input data!"
			];
		}
		
		return Response::json($data);
	}
	
	public function deleteDelete($id){
		if (is_numeric($id)){
			ReviewService::delete($id);
			$data = [
			'status' => true,
			'message' => "Deleted!"
					];
		} else {
			$data = [
			'status' => false,
			'message' => "Wrong input data!"
					];
		}
	
		return Response::json($data);
	}
	
	public function getCreate() {
		$review = new Review();
		
		$review->rating = 4;
		$review->isApproved = true;
		$review->product_id = 1;
		$review->guestEmail = 'admin@localhost';
		
		$result = $review->save();
		
		echo "$result <hr>";
	}
	
}