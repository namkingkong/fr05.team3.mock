<?php
namespace Fr05\AjaxWebService\Controller;

use Illuminate\Support\Facades\Response;
use Fr05\Service\CommentService;
use Fr05\Model\Comment;

class CommentAjaxController extends \BaseController{
		
	public function getDelete($id){
		if (is_numeric($id)){
			CommentService::delete($id);
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
	
	
}