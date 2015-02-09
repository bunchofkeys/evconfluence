<?php

class Teaching_Period extends \Eloquent {
	protected $table = 'teaching_period';
	protected $primaryKey = 'period_id';
	protected $fillable = ['user_id', 'semester_code', 'year', 'unit_code'];
	public $timestamps = false;

}