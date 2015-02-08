<?php

class Team extends \Eloquent {
	protected $table = 'team';
	protected $fillable = ['student_id', 'period_id', 'team_id'];
	public $timestamps = false;
}