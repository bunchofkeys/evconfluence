<?php

class ConfigModel extends \Eloquent
{
    protected $table = 'config';
    protected $primaryKey = 'config_id';
    protected $fillable = ['key', 'value', 'description'];
    public $timestamps = false;

}