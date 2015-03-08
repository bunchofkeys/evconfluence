<?php

class TemporaryLinkModel extends \Eloquent {
	// settings
	protected $table = 'temporary_link';
	protected $primaryKey = 'link_id';
	protected $fillable = ['token', 'person_id', 'action', 'startDateTime', 'endDateTime', 'active'];
	public $timestamps = false;

}