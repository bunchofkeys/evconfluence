<?php

class FormModel extends \Eloquent {
	protected $table = 'form';
	protected $primaryKey = 'form_id';
	protected $fillable = ['start_date_time', 'end_date_time', 'status'];
	public $timestamps = false;
}