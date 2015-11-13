<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    /**
     * The database table used by the model.
     * 
     * @var string
     */
    protected $table = 'answers';

    /**
     * The attributes that are mass assigned.
     * 
     * @var array
     */
    protected $fillable = [
    	'answer', 
		'question_id'
	];

	/**
	 * An answer belongs to a question
	 *
	 * @return the question
	 */
	public function question() {
		return $this->belongsTo('App\Question');
	}
}
