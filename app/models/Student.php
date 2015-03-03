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

	public function teams()
	{
		return $this->hasMany('Team', 'student_id', 'student_id');
	}

	public function team($periodId)
	{
		return Team::where(['student_id' => $this->student_id, 'period_id' => $periodId])->first();
	}

	public function period()
	{
		return $this->belongsToMany('Teaching_Period', 'team', 'student_id', 'period_id');
	}
}