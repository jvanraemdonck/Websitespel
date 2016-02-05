<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionTime extends Model
{
    /**
     * The database table used by the model.
     * 
     * @var string
     */
    protected $table = 'question_times';

    /**
     * The attributes that are mass assigned.
     * 
     * @var array
     */
    protected $fillable = [
    	'team_id',
    	'question_id',
    	'start_time',
    	'tip',
    	'end_time',
    	'delta_time'
	];

	/**
	 * no timestamps for this entity
	 * 
	 * @var boolean
	 */
	public $timestamps = false;

	/**
	 * A question time has one team
	 * 
	 * @return relation
	 */
	public function team() 
	{
		return $this->hasOne('App\Team');
	}

	/**
	 * A question time has one question
	 * 
	 * @return relation
	 */
	public function question() 
	{
		return $this->hasOne('App\Question');
	}
}