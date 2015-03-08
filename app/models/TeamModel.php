<?php

class TeamModel extends \Eloquent {
	protected $table = 'team';
	protected $fillable = ['student_id', 'period_id', 'team_id'];
	public $timestamps = false;

	public function period()
	{
		return $this->hasOne('TeachingPeriodModel', 'period_id', 'period_id');
	}

	public function student()
	{
		return $this->belongsTo('StudentModel', 'student_id', 'student_id');
	}
}