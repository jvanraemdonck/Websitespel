<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    /**
     * The database table used by the model.
     * 
     * @var string
     */
    protected $table = 'questions';

    /**
     * The attributes that are mass assigned.
     * 
     * @var array
     */
    protected $fillable = [
    	'question',
		'tip', 
		'tip_alters_question', 
		'question_type',
        'sequence',
	];

    /**
     * A question has many answers
     *
     * @return answers for this question
     */
    public function answers() 
    {
    	return $this->hasmany('App\Answer');
    }

    /**
     * Returns the number of answers for this question
     * 
     * @return integer number of answers
     */
    public function answersCount() 
    {
        return $this->hasmany('App\Answer')->count();
    }
}
