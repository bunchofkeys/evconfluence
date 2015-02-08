<?php

class Student extends \Eloquent {
	protected $table = 'student';
	protected $primaryKey = 'student_id';
	protected $fillable = ['person_id'];
	public $timestamps = false;

	public function person()
	{
		return $this->belongsTo('Person', 'person_id', 'person_id');
	}

	public function teaching_period()
	{
		return $this->belongsToMany('Teaching_Period', 'team', 'student_id', 'period_id');
	}

	public function team()
	{
		return $this->belongsTo('Team', 'student_id', 'student_id');
	}
}