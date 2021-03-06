<?php

class TeacherModel extends \Eloquent
{
    // settings
    protected $table = 'teacher';
    protected $primaryKey = 'teacher_id';
    protected $fillable = ['user_id', 'school', 'unit_required_for'];
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo('UserModel', 'user_id', 'user_id');
    }
}