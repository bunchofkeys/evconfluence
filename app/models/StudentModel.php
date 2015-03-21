<?php

class StudentModel extends \Eloquent {
	protected $table = 'student';
	protected $primaryKey = 'student_id';
	protected $fillable = ['person_id'];
	public $timestamps = false;

	public function person()
	{
		return $this->belongsTo('PersonModel', 'person_id', 'person_id');
	}

	public function teams()
	{
		return $this->hasMany('TeamModel', 'student_id', 'student_id');
	}

	public function team($periodId)
	{
		return TeamModel::where(['student_id' => $this->student_id, 'period_id' => $periodId])->first();
	}

	public function period()
	{
		return $this->belongsToMany('TeachingPeriodModel', 'team', 'student_id', 'period_id');
	}

	public function delete()
	{
		TeamModel::where('student_id', $this->student_id)->delete();
		$this->person()->delete();
		return parent::delete();
	}
}