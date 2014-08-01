<?php
namespace Fr05;

use Fr05\Dao\BrandService;

class DemoController extends \BaseController {
	
	public function getIndex() {
		return \View::make('demo.demo');
	}
	
	public function getHello() {
		return 'Hello';
	}
	
	public function getGoodBye() {
		return 'Good Bye';
	}
	
	/**
	 * Hien tai no co URI dang /delete/{id}
	 * 
	 * Su dung phuong thuc GET
	 * 
	 * cai {id} sau cung kia se duoc nap vao argument $id cua ham. OK? 
	 * ờ, đấy là getdelete
	 * 
	 * @param unknown $id
	 */
	public function deleteDelete($id) {
		if (is_numeric($id)) {
			$data = [
				'status' => true,
				'message' => "Day la ham xoa. ID = $id duoc chap nhan"
			];
		}
		else {
			$data = [
				'status' => false,
				'message' => "Day la ham xoa. ID = $id KHONG duoc chap nhan. Chi chap nhan so."
			];
		}
		
		return \Response::json($data);
	}
	
	public function getDemoJsonParam() {
		echo '<pre>';
		dd(\Input::all());
		echo '</pre>';
	}
	
}
