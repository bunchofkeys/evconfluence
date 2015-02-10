<?php

class Team extends \Eloquent {
	protected $table = 'team';
	protected $fillable = ['student_id', 'period_id', 'team_id'];
	public $timestamps = false;

	public function teaching_period()
	{
		return $this->belongsTo('Teaching_Period', 'period_id', 'period_id');
	}

	public function student()
	{
		return $this->belongsTo('Student', 'student_id', 'student_id');
	}
}