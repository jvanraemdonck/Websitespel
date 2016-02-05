<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    /**
     * The database table used by the model.
     * 
     * @var string
     */
    protected $table = 'teams';

	/**
     * The attributes that are mass assigned.
     * 
     * @var array
     */
    protected $fillable = [
    	'teamname',
		'avatar', 
		'color'
	];

	/**
	 * a team has one user
	 * 
	 * @return user the user
	 */
	public function user()
	{
		return $this->hasOne('App\User');
	}
}
