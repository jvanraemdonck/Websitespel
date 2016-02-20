<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Websitespel extends Model
{
    /**
     * The database table used by the model.
     * 
     * @var string
     */
    protected $table = 'websitespellen';

	/**
     * The attributes that are mass assigned.
     * 
     * @var array
     */
    protected $fillable = [
    	'start_date',
    	'ended'
	];

    protected $dates = ['start_date', 'created_at', 'updated_at'];
}
