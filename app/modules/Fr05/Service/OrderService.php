<?php
namespace Fr05\Service;

use Fr05\Model\Order;
use Illuminate\Support\Facades\DB;
use Fr05\Model\OrderDetail;

class OrderService{
	
	public static function getAll(){
		return Order::all();		
	}
	
	public static function getById($id){
		return Order::find($id);
	}
	
	public static function delete($id){
		return Order::destroy($id);
	}

	public static function insert($order) {
		// Set TIME
		$order->time = date("Y-m-d H:i:s");
		
		// For security
		unset($order->id);
		
		$result = null;
		
		DB::transaction(function() use (& $order, & $result) {
			$result = $order->save();
			
			$orderDetailsCollection = $order->orderDetails();
			
			foreach (CartService::getAll() as $productId => $item)
			{
				$orderDetailsCollection->insert([
						'order_id' => $order->id,
						'product_id' => $productId,
						'product_name' => $item['product']->name,
						'price' => $item['product']->sales_price ? $item['product']->sales_price : $item['product']->list_price,
						'quantity' => $item['quantity']
				]);
			}
		});
		
		return $result;
	}
}