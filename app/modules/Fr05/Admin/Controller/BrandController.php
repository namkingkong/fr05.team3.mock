<?php
namespace Fr05\Admin\Controller;

use Fr05\Service\BrandService;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Input;
use Fr05\Model\Brand;
use Illuminate\Support\Facades\Redirect;
use Fr05\Model\Product;
use Illuminate\Support\Facades\Validator;
use Fr05\Helper\Config;
use Illuminate\Support\Facades\Response;

class BrandController extends \BaseController {
	
	/**
	 * 
	 */
	public function getIndex() {
		$brands = Brand::paginate(Config::get('row_per_page'));
		
		// Show page
		return View::make(VIEW_ADMIN . '::brand.list')->with('brands',$brands)->with('paginationEnable','true');
	}
	
	public function postIndex() {
		$keyword = Input::get('keyword');
		if($keyword) {
			$brands= Brand::where('name','Like','%'.$keyword.'%')->get();
			return View::make(VIEW_ADMIN .'::brand.list')->with('brands',$brands)->with('keyword',$keyword);
		} else {
			return $this->getIndex();
		}
	
	}
	
	/**
	 * @param unknown $id
	 */
	public function getDetails($id) {
		$data = [];
		
		$data['brand'] = BrandService::getById($id);
		$data['products'] = $data['brand']->products;
		
		return View::make(VIEW_ADMIN . '::brand.details', $data);
	}
	
	/**
	 * 
	 */
	public function getCreate() {
		return View::make(VIEW_ADMIN . '::brand.form', ['brand' => new Brand()]);
	}
	
	/**
	 * 
	 */
	public function postCreate() {
		$brand = new Brand(Input::get('brand'));
		
		// Validate
		$validator = $brand->validate();
		
		if ($validator->fails()) {
			return Redirect::action(BrandController::class . '@getCreate')
						->withInput()
						->withErrors($validator);
		}
		
		// Save Brand
		if (! BrandService::save($brand)) {
			dd('Failed');
		}
		
		return Redirect::action(BrandController::class . '@getIndex');
	}
	
	/**
	 * 
	 */
	public function getUpdate($id) {
		$data = [];
		
		$data['brand'] = BrandService::getById($id);
		
		return View::make(VIEW_ADMIN . '::brand.form', $data);
	}
	
	/**
	 * 
	 */
	public function postUpdate($id) {
		$brand = BrandService::getById($id);
		$brand->fill(Input::get('brand'));
		
		// Validate
		$validator = $brand->validate();
		
		if ($validator->fails()) {
			return Redirect::action(BrandController::class . '@getUpdate', $id)
							->withInput()
							->withErrors($validator);
		}
		
		// Save		
		if (! BrandService::save($brand)) {
			return 'Failed';
		}
		
		return Redirect::action(BrandController::class . '@getIndex');
	}
	
	/**
	 * 
	 */
	public function deleteDelete($id) {
		if(is_numeric($id)){
			BrandService::delete($id); 
			$data = [
			'status' => true, 
			'message' => "Deleted!" 
					];
		} else {
			$data = [
			'status' => false,
			'message' => "Something has gone wrong!"
			];
		}
		return Response::json($data);
	}
}
