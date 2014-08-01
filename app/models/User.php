<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use Fr05\Model\Review;
use Fr05\Model\Comment;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait, Fr05\Model\SelfValidatable;
	
	public $timestamps = false;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'user';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');
	
	/**
	 * Disable guarded fields by using an empty array
	 * 
	 * @var array
	 */
	protected $guarded = [];

	public function getRememberToken()
	{
		return null; // not supported
	}
	
	public function setRememberToken($value)
	{
		// not supported
	}
	
	public function getRememberTokenName()
	{
		return null; // not supported
	}
	
	/**
	 * Overrides the method to ignore the remember token.	
	 */
	public function setAttribute($key, $value)
	{
		$isRememberTokenAttribute = $key == $this->getRememberTokenName();
		if (!$isRememberTokenAttribute)
		{
			parent::setAttribute($key, $value);
		}
	}
	
	/**
	 * Validation Rules
	 *
	 * @var array
	 */
	public function getRules() {
		return [ 
				'default' => [ 
						'username' => "required | unique:user,username,$this->id",
						'email' => "required | unique:user,email,$this->id",
						'authorization' => 'required',
						'password' => 'sometimes|required',
						'name' => "required",
						'address' => "required",
						'phone' => "required | numeric",
				]
		];
	}
	
	/**
	 * This User's Review
	 */
	public function review() {
		return $this->hasOne(Review::class);
	}

	/**
	 * This User's Comments
	 */
	public function comments() {
		$this->hasMany(Comment::class);
	}
	
}
