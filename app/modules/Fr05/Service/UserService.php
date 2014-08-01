<?php
namespace Fr05\Service;
use User;
use Fr05\Helper\Config;

class UserService {
	
	public static function getAll() {
		return User::paginate(Config::get('row_per_page'));
	}
	
	public static function getById($id) {
		return User::find($id);
	}

	public static function save(User $object) {
		return $object->save();
	}
	
	public static function delete($id) {
		return User::destroy($id);
	}
}
