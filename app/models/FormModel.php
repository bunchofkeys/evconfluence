<?php

class FormModel extends \Eloquent {
	protected $table = 'form';
	protected $primaryKey = 'form_id';
	protected $fillable = ['start_date_time', 'end_date_time', 'status'];
	public $timestamps = false;

	public function teaching_period()
	{
		return $this->belongsTo('Teaching_Period', 'period_id', 'period_id');
	}
}