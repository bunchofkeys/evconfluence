<?php

class ResultModel extends \Eloquent
{
	protected $table = 'result';
	protected $primaryKey = 'result_id';
	protected $fillable = ['start_date_time', 'end_date_time', 'status'];
	public $timestamps = false;

}