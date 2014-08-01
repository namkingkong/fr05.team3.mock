<?php
namespace Fr05\Admin\Controller;

use Illuminate\Support\Facades\View;
use Fr05\Service\ProductService;
use Fr05\Model\Product;

class CommentController extends \BaseController {
	
	public function getIndex(){
		
		$allProduct = ProductService::getAll();
		$productCommentCount = [];
		
		foreach($allProduct as $key => $product){

			$productCommentCount[$product->id]['numberComment'] = $product->comments->count();

			$productCommentCount[$product->id]['name'] = $product->name;
		}
		
		
		return View::make(VIEW_ADMIN. '::comment.list') -> with ('commentList',$productCommentCount);
	}
	
	public function getEdit($id){
		$data['product'] = Product::find($id);
		
		return View::make(VIEW_ADMIN. '::comment.edit', $data);
	}
}