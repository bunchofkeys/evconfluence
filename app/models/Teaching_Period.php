<?php

class Teaching_Period extends \Eloquent {
	protected $table = 'teaching_period';
	protected $primaryKey = 'period_id';
	protected $fillable = ['user_id', 'semester_code', 'year', 'unit_code'];
	public $timestamps = false;

	public function students()
	{
		return $this->belongsToMany('Student','team','period_id','student_id');
	}

	public function form()
	{
		return $this->hasOne('Form', 'period_id', 'period_id');
	}
}