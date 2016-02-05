<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Progress extends Model
{
    /**
     * The database table used by the model.
     * 
     * @var string
     */
    protected $table = 'progress';

    /**
     * The attributes that are mass assigned.
     * 
     * @var array
     */
    protected $fillable = [
    	'team_id',
		'question_id',
	];

	/**
	 * Progress has one team
	 * 
	 * @return relation with team
	 */
	public function team() {
		return $this->hasOne('App\Team');
	}

	/**
	 * Progress has one question
	 * 
	 * @return relation
	 */
	public function question() {
		return $this->hasOne('App\Question');
	}
}
