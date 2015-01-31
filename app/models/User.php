<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends BaseModel implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	// settings
	protected $table = 'user';
	protected $primaryKey = 'user_id';
	protected $hidden = array('password', 'remember_token');
	protected $fillable = ['username', 'password', 'status', 'role'];
	public $timestamps = false;

	// validation rules
	protected $rules = array(
		'username' => 'required|unique:user|Email',
		'password' => 'required',
		'role' => 'required|in:Admin,Teacher',
		'status' => 'required|in:Pending,Approved,Rejected,Locked',
	);

	public function person()
	{
		return $this->belongsTo('Person', 'person_id', 'person_id');
	}

	public function teacher()
	{
		if($this->role == 'Teacher')
		{
			return $this->hasOne('Teacher', 'user_id', 'user_id');
		}
	}

}
