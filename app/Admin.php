<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    
    /**
     * The database table used by the model.
     * 
     * @var string
     */
    protected $table = 'admins';

    /**
     * The attributes that are mass assigned.
     * 
     * @var array
     */
    protected $fillable = ['longname', 'avatar'];

    /**
     * An Admin is a user
     * 
     * @return user related to this admin
     */
    public function user() 
    {
		return $this->belongsTo('App\User');
    }
}
