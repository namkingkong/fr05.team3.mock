<?php
namespace Fr05\Model;

abstract class BaseModel extends \Eloquent {

	use SelfValidatable;
	
	protected $guarded = array();
	
	public $timestamps = false;
	
}
