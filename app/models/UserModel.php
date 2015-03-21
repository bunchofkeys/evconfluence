<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class UserModel extends \Eloquent implements UserInterface, RemindableInterface
{
	use UserTrait, RemindableTrait;

	// settings
	protected $table = 'user';
	protected $primaryKey = 'user_id';
	protected $hidden = array('password', 'remember_token');
	protected $fillable = ['username', 'password', 'status', 'role'];
	public $timestamps = false;

	public function person()
	{
		return $this->belongsTo('PersonModel', 'person_id', 'person_id');
	}

	public function teacher()
	{
		if ($this->role == 'Teacher') {
			return $this->hasOne('TeacherModel', 'user_id', 'user_id');
		}
	}

	public function delete()
	{
		TeacherModel::where('user_id', $this->user_id)->delete();
		return parent::delete();
	}

}
