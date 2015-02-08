<?php

class Teaching_Period extends \Eloquent {
	protected $table = 'teaching_period';
	protected $primaryKey = 'period_id';
	protected $fillable = ['user_id', 'period_id', 'unit_code'];
	public $timestamps = false;

}