<?php
namespace Fr05\Admin\Controller;

use Illuminate\Support\Facades\View;
use Fr05\Helper\Config;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class ConfigController extends \BaseController {
	
	public function getIndex() {
		$configList = Config::getAll();
		
		return View::make(VIEW_ADMIN . '::config.index')->with('configList', $configList);
	}
	
	public function postIndex() {
		$config = Input::get('config');
		
		Config::setAll($config);
		
		$result = Config::save($GLOBALS['json_config_path']);
		
		if (! $result) {
			return 'Failed to save. Check log for more information.';
		}
		
		return Redirect::to('admin/config');
	}
}
