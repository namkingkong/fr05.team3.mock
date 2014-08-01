<?php
namespace Fr05\Admin\Controller;

use Fr05\Service\CategoryService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Input;
use Fr05\Model\Category;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;

class CategoryController extends \BaseController {
	public function getIndex() {
		/*
		 * Get all objects from DB
		*/
		$categoryList = CategoryService::getAll();
				/*
		 * Show page
		*/
		return View::make(VIEW_ADMIN . '::category.list') -> with('categoryList',$categoryList);
	}
	
	/**
	 * @param unknown $id
	 */
	public function getDetails($id) {
		echo '<pre>' . print_r(Category::getById($id), true) . '</pre>';
	}
	
	/**
	 *
	 */
	public function getCreate() {
		$data = [
				'caption'	=> 'Create Category',
				'category'	=> new Category(),
				'categories'=> CategoryService::getAll()
		];
		
		return View::make(VIEW_ADMIN . '::category.form', $data);
	}
	
	/**
	 *
	 */
	public function postCreate() {
		$categoryInput = Input::get('category');
		
		// If parent_id is empty, set it to NULL
		if (empty($categoryInput['parent_id'])) {
			$categoryInput['parent_id'] = null;
		}
		
		// Modify the category
		$category = new Category($categoryInput);
		
		// Validate
 		$validator = $category->validate();
		
		if ($validator->fails ()) {
			return Redirect::action ( CategoryController::class . '@getCreate' )->withInput()->withErrors($validator);
		}
		
		if (! CategoryService::save($category)) {
			dd('Failed');
		}
		
		return Redirect::action(CategoryController::class . '@getIndex');
	}
	
	/**
	 *
	 */
	public function getUpdate($id) {
		$data['caption'] = 'Edit Category';
		$data['category'] = CategoryService::getById($id);
		$data['categories'] = CategoryService::getAllExcept([$data['category']->id]);
		
		return View::make(VIEW_ADMIN . '::category.form', $data);
	}
	
	/**
	 *
	 */
	public function postUpdate($id) {
		$categoryInput = Input::get('category');
		
		// If parent_id is empty, set it to NULL
		if (empty($categoryInput['parent_id'])) {
			$categoryInput['parent_id'] = null;
		}
		
		// Modify the category
		$category = CategoryService::getById($id);
		$category->fill($categoryInput);
		
		// Validate
		$validator = $category->validate();
		
		if ($validator->fails ()) {
			return Redirect::action(CategoryController::class . '@getUpdate', $category['id'])
							->withInput()
							->withErrors($validator);
		}

		// Save
		if (! CategoryService::save($category)) {
			return 'Failed';
		}
	
		return Redirect::action(CategoryController::class . '@getIndex');
	}
	
	/**
	 *
	 */
	
	public function deleteDelete($id) {
		if(is_numeric($id)){
				DB::transaction(function() use ($id) {
					// Retrieve the category to be deleted
					$category = CategoryService::getById($id);
					
					// Get all children of the category to be deleted
					$children = CategoryService::getAllFirstLevelChildren($id);
					
					foreach ($children as $curChild){
						$curChild->parent_id = $category->parent_id;
					}
					
					// Save the children
					CategoryService::saveMany($children);
					
					// Delete the requested category
					CategoryService::delete($id);
				});
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
	
	public function getReorder() {
		$data = [
				'categories' => CategoryService::getAllTopLevel(),
		];
		
		return View::make(VIEW_ADMIN . '::category.re-order', $data);
	}
	
	public function postReorder() {
		$categoriesInput = Input::all();
		
		$categories = [];
		
		foreach ($categoriesInput as $categoryInput) {
			// Get the category from DB
			$curCategory = CategoryService::getById($categoryInput['id']);
			
			// Modify its properties
			$curCategory->parent_id = $categoryInput['parent_id'];
			$curCategory->index = $categoryInput['index'];
			
			// Put it in the list
			$categories[] = $curCategory;
		}
		
		try {
			CategoryService::saveMany($categories);
			
			return Response::json([
					'success'	=> true,
					'data'		=> Category::all()
			]);
		}
		catch (\Exception $ex) {
			return Response::json([
					'success'	=> false,
					'content'	=> $ex->getMessage()
			], 401);
		}
	}
}