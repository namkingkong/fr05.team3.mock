<?php
namespace Fr05\Helper;

class Config {
	
	protected static $config = [];
	
	public static function load($path) {
		$content = file_get_contents($path);
		
		static::$config = json_decode($content, true);
			
		return $content != false;
	}
	
	public static function save($path) {
		$result = file_put_contents($path, json_encode(static::$config));
		
		return $result != false;
	}
	
	public static function getAll() {
		return static::$config;
	}
	
	public static function get($key) {
		return static::$config[$key];
	}
	
	public static function set($key, $val) {
		static::$config[$key] = $val;
	}
	
	public static function setAll(array $config) {
		static::$config = $config;
	}
	
	public static function remove($key) {
		unset(static::$config[$key]);
	}
	
}
