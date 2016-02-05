<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeamAnswer extends Model
{
    /**
     * The database table used by the model.
     * 
     * @var string
     */
    protected $table = 'team_answers';

    /**
     * The attributes that are mass assigned.
     * 
     * @var array
     */
    protected $fillable = [
    	'team_id',
		'question_id', 
		'answer', 
		'correct'
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
}
