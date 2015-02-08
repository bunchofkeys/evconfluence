<?php

class SectionModel extends \Eloquent {
	protected $table = 'section';
	protected $fillable = ['form_id', 'question_id'];
	public $timestamps = false;

	public function question()
	{
		return $this->hasOne('QuestionModel', 'question_id', 'question_id');
	}
}