<?php
namespace Fr05\Admin\Controller;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Fr05\Model\Order;
use Fr05\Model\OrderDetail;
use Fr05\Service\OrderService;
use Fr05\Service\ProductService;
use Fr05\Service\UserService;
use Fr05\Service\OrderDetailService;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facedes\Redirect;
use Illuminate\Support\Collection;

class OrderController extends Controller{
	
	public function getIndex() {
		$orderList = Order::paginate(5);
		
		return View::make (VIEW_ADMIN . '::order.list')
				->with('orderList',$orderList)
				->with('paginationEnable','true');
	}
	
	
	public function getDetail($id) {
		$order = Order::find($id);
		
		return View::make(VIEW_ADMIN . '::order.detail')
					->with('order',$order);
		;
		
	}
	/*
	public function postIndex() {
		$keyword = Input::get('keyword');
		//echo $keyword;
		if($keyword) {
			$orderList = Order::where('name','Like','%'.$keyword.'%')->get();
			return View::make(VIEW_ADMIN .'::order.list')->with('orderList',$orderList)->with('keyword',$keyword);
		} else {
			return $this->getIndex();
		}
	}
	*/
	
	public function getSetPaid(){
		
	}
	
	public function getDelete($id){
		DB::transaction(function() use ($id){
			//delete order
			$order = Order::find($id);
			$order->delete();
		});
		return \Redirect::action(OrderController::class . '@getIndex');
	}	
}