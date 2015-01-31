<?php

/**
 * @property  first_name
 */
class Person extends BaseModel {
	// settings
	protected $table = 'person';
	protected $primaryKey = 'person_id';
	protected $fillable = ['first_name', 'last_name', 'title', 'email'];
	public $timestamps = false;

	// validation rules
	protected $rules = array(
		'first_name' => 'required',
		'last_name' => 'required',
		'title' => 'required|in:Mr,Ms',
		'email' => 'required|unique:person|Email',
	);

	public function user()
	{
		return $this->hasOne('User', 'person_id', 'person_id');
	}
}