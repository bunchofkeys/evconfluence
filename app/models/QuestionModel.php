<?php

class QuestionModel extends \Eloquent
{
	protected $table = 'question';
	protected $primaryKey = 'question_id';
	protected $fillable = ['question_text', 'question_number', 'format', 'type'];
	public $timestamps = false;

	public function section()
	{
		return $this->belongsTo('SectionModel', 'question_id', 'question_id');
	}
}