<?php
namespace Fr05\Admin\Controller;

use Fr05\Service\UserService;
use User;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;

class UserController extends \BaseController {
	
	public function getUpdate($id){
		$data['user'] = UserService::getById($id);
		return View::make(VIEW_ADMIN . '::user.update', $data);
	}
	
	public function postUpdate($id) {
		$userInput = Input::get('user');
		
		// Modify the category
		$user = UserService::getById($id);
		$user->fill($userInput);
		
		// Validate
		$validator = $user->validate();
		
		if ($validator->fails ()) {
			return Redirect::action ( UserController::class . '@getUpdate',$user['id'] )
																						->withInput()
																						->withErrors($validator);
		}
		
		if (! UserService::save($user)) {
			dd('Failed');
		}
		
		return Redirect::action(UserController::class . '@getIndex');
	}
	
	public function deleteDelete($id){
		if(is_numeric($id)){
			UserService::delete($id); 
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
	
	public function getIndex() {
		$userList = array();
		$userList = UserService::getAll();
		return View::make(VIEW_ADMIN . '::user.list')->with('listUser',$userList)->with('paginationEnable','true');
	}
	
	public function getCreate() {
		$data = [
			'user'	=> new User(),
		];
		return View::make(VIEW_ADMIN . '::user.form',$data);
	}
	
	public function postCreate() {
		$userInput = Input::get('user');

		// Modify the category
		$user = new User($userInput);
		
		// Validate
		$validator = $user->validate();
		
		if ($validator->fails ()) {
			return Redirect::action ( UserController::class . '@getCreate' )->withInput()->withErrors($validator);
		}
		
		if (! UserService::save($user)) {
			dd('Failed');
		}
		
		return Redirect::action(UserController::class . '@getIndex');
		
	}
}