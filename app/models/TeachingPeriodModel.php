<?php

class TeachingPeriodModel extends \Eloquent {
	protected $table = 'teaching_period';
	protected $primaryKey = 'period_id';
	protected $fillable = ['user_id', 'semester_code', 'year', 'unit_code'];
	public $timestamps = false;

	public function students()
	{
		return $this->belongsToMany('StudentModel','team','period_id','student_id');
	}

	public function form()
	{
		return $this->hasOne('FormModel', 'period_id', 'period_id');
	}

	public function delete()
	{
		TeamModel::where('period_id', $this->period_id)->delete();
		FormModel::where('form_id', $this->form_id)->delete();
		return parent::delete();
	}
}