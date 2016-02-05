<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    /**
     * The database table used by the model.
     * 
     * @var string
     */
    protected $table = 'events';

    /**
     * The attributes that are mass assigned.
     * 
     * @var array
     */
    protected $fillable = [
    	'type_id',
		'time', 
		'team_id', 
		'question_id'
	];

	/**
	 * This team answer has one team
	 * 
	 * @return team for this team_answer
	 */
	public function team()
	{
		return $this->hasOne('App\Team');
	}

	/**
	 * this team answer has one question
	 * 
	 * @return question for this team_answer
	 */
	public function question() 
	{
		return $this->hasOne('App\Question');
	}

	/**
	 * An event has an event type
	 * 
	 * @return the related event type
	 */
	public function type()
	{
		return $this->hasOne('App\Type');
	}
}
