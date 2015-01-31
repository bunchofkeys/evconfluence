<?php

class Teacher extends BaseModel
{
    // settings
    protected $table = 'teacher';
    protected $primaryKey = 'teacher_id';
    protected $fillable = ['user_id', 'school', 'unit_required_for'];
    public $timestamps = false;

    // validation rules
    protected $rules = array(
        'user_id' => 'required',
        'school' => 'required',
        'unit_required_for' => 'required',
    );

    public function user()
    {
        return $this->belongsTo('User', 'user_id', 'user_id');
    }
}