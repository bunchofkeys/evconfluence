<?php

class AnswerModel extends \Eloquent
{
    protected $table = 'answer';
    protected $primaryKey = 'answer_id';
    protected $fillable = ['submission_id', 'question_id', 'target_student_id', 'input'];
    public $timestamps = false;

}