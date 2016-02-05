<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventType extends Model
{
    /**
     * The database table used by the model.
     * 
     * @var string
     */
    protected $table = 'event_types';

    /**
     * The attributes that are mass assigned.
     * 
     * @var array
     */
    protected $fillable = [
    	'name',
		'event_text', 
		'big_event'
	];
}
