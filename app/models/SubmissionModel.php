<?php
class SubmissionModel extends \Eloquent {
    protected $table = 'submission';
    protected $primaryKey = 'submission_id';
    protected $fillable = ['form_id', 'student_id', 'alert', 'status', 'submisison_date_time'];
    public $timestamps = false;

    public function student()
    {
        return $this->belongsTo('StudentModel', 'student_id', 'student_id');
    }

}