<?php

namespace Fr05\Auth\Controller;

use User;
use Fr05\Service\UserService;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;

class AuthController extends \BaseController {
	
	/**
	 * Show login page
	 */
	public function getLogin() {
		return View::make ( VIEW_AUTH . '::login' );
	}
	
	/**
	 * Login.
	 * If login successfully, check authorization.
	 * - If the account is ADMIN, redirect to Admin home page
	 * - If not, redirect to Shop home page
	 */
	public function postLogin() {
		$rules = [ 
				'username' => 'required',
				'password' => 'required' 
		];
		
		$validator = Validator::make ( Input::all (), $rules );
		
		if ($validator->fails ()) {
			return Redirect::to ( '/auth/login' )->withErrors ( $validator )->			// send back all errors to the login form
			withInput ( Input::except ( 'password' ) ); // send back the input (not the password) so that we can repopulate the form
		} else {
			$userdata = array (
					'username' => Input::get ( 'username' ),
					'password' => Input::get ( 'password' ) 
			);
			
			if (Auth::attempt ( $userdata )) {
				// return Redirect::to ( '/auth/login' )->with ( 'message', 'SUCCESS!' );
				return Redirect::to ( '/admin/brand' )->with ( 'message', 'SUCCESS!' );
			} else {
				return Redirect::to ( '/auth/login' )->with ( 'message', 'Wrong username or password!' );
			}
		}
	}
	
	/**
	 * Logout, and redirect to login page
	 */
	public function getLogout() {
		Auth::logout ();
		return Redirect::to ( '/auth/login' );
	}
	
	/**
	 * Show Register page
	 */
	public function getRegister() {
		return View::make ( VIEW_AUTH . '::register', [ 
				'user' => new User () 
		] );
	}
	
	/**
	 * Register new account.
	 * If success, redirect to login page
	 */
	public function postRegister() {
		$rules = [ 
				'username' => 'required|unique:user',
				'email' => 'required|email|unique:user',
				'password' => 'required|min:8|same:cpassword',
				'cpassword' => 'required|min:8' 
		];
		
		$userData = Input::get ( 'user' );
		
		$validator = Validator::make ( $userData, $rules );
		
		if ($validator->fails ()) {
			return Redirect::to ( '/auth/register' )->withErrors ( $validator )->			// send back all errors to the login form
			withInput ( Input::except ( 'password' ) ); // send back the input (not the password) so that we can repopulate the form
		} else {
			$userData ['password'] = Hash::make ( $userData ['password'] );
			
			// Remove cpassword field from Input array before fill in the User object
			unset ( $userData ['cpassword'] );
			$userData ['authorization'] = 2;
			
			$user = new User ( $userData );
			
			if (! UserService::save ( $user )) {
				return Redirect::to ( '/auth/register' )->with ( 'message', 'Can not create user!' );
			}
			
			return Redirect::action ( AuthController::class . '@getLogin' );
		}
	}
}
