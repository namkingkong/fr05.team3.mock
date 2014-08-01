<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

Route::filter('authAdmin', function()
{
	if(!Auth::check()){
		return Redirect::to('/auth/login')->with("message","Please login first!");
	}else if(Auth::user()->authorization != 1){
		return "You are not allowed to enter this area!";
	}
});

Route::when('admin/*', 'authAdmin');

Route::filter('authAll', function()
{
	if(Auth::check()){
		return Redirect::to('/admin');
	}
});

Route::get('auth/login', array('before' => 'authAll', 'uses' => '\Fr05\Auth\Controller\AuthController@getLogin'));
Route::get('auth/register', array('before' => 'authAll', 'uses' => '\Fr05\Auth\Controller\AuthController@getRegister'));
