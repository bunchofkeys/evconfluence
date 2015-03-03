<?php

/**
 * @property  first_name
 */
class Person extends \Eloquent
{
	// settings
	protected $table = 'person';
	protected $primaryKey = 'person_id';
	protected $fillable = ['first_name', 'last_name', 'title', 'email'];
	public $timestamps = false;

	public function user()
	{
		return $this->hasOne('User', 'person_id', 'person_id');
	}

	public function student()
	{
		return $this->hasOne('Student', 'person_id', 'person_id');
	}
}