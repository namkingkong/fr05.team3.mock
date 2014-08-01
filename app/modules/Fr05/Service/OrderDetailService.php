<?php 
namespace Fr05\Service;
use Fr05\Model\Order;
use Fr05\Model\OrderDetail;

class OrderDetailService{
	
	public static function findByOrderId($orderId){
		return OrderDetail::where('order_id', $orderId)->get();
	}   
}