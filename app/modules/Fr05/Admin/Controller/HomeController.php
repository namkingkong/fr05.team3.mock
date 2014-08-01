<?php
namespace Fr05\Admin\Controller;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

class HomeController extends \BaseController {
	
	public function getIndex() {
		if(!Auth::check()){
			return Redirect::to( '/auth/login' );
		} elseif(Auth::user()->authorization == 1){
			return View::make(VIEW_ADMIN.'::home.index');
		}
	}
	
}
