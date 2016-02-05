<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['username', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * Check to see if the user is an admin
     * 
     * @return boolean the user is an admin
     */
    public function isAdmin()
    {
        return $this->admin;
    }

    /**
     * returns the admin object related to the user if applicable
     * 
     * @return Admin the admin object
     */
    public function admin()
    {
        return $this->hasOne('App\Admin');
    }

    /**
     * return the team object relates to the user is applicable
     * 
     * @return Team the team object
     */
    public function team()
    {
        return $this->hasOne('App\Team');
    }
}
