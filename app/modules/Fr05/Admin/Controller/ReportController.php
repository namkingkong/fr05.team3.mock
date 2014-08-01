<?php
namespace Fr05\Admin\Controller;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Collection;

use Fr05\Model\Product;
use Fr05\Model\Category;
use Fr05\Model\Order;
use Fr05\Model\OrderDetail;

class ReportController extends Controller {
	
	public function getIndex() {
		$start = Input::get('start_date') ? Input::get('start_date').' 00:00:00' : '2000-01-01 08:00:00';
		$end = Input::get('end_date') 	  ?	Input::get('end_date').	' 23:59:59' : '2014-12-31 23:59:59';
		
		$productList = DB::table('order')
					->Join('order_detail', 'order.id', '=', 'order_detail.order_id')
					->Join('product', 'order_detail.product_id', '=' , 'product.id')
					->select('order.id','order.time','product.name','order_detail.price', DB::raw("count(*) as sum_quantity"))
					->whereBetween('order.time', [$start, $end])
					->groupby('product.id')
					->orderby('sum_quantity', 'desc')
           			->get();
		
		$categoryList = DB::table('order')
					->Join('order_detail', 'order.id', '=', 'order_detail.order_id')
					->Join('product', 'order_detail.product_id', '=' , 'product.id')
					->Join('product_category', 'product_category.product_id', '=', 'product.id')
					->Join('category', 'product_category.category_id', '=', 'category.id')
					->select('order.id','order.time','product.name','order_detail.price', DB::raw("category.name as category_name"), DB::raw("count(*) as sum_quantity"))
					->whereBetween('order.time', [$start, $end])
					->groupby('product_category.category_id')
					->orderby('sum_quantity', 'desc')
           			->get();
		
// 		echo '<pre>';
// 		print_r($categoryList);
// 		echo '</pre>';
		
		return View::make ( VIEW_ADMIN . '::report.list' )->with('productList',$productList)->with('categoryList',$categoryList)->with('time',$time = array('start'=>$start, 'end'=>$end));
	}
	
}