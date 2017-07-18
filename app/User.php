<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','user_type',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];



    public function isAdmin()
    {
        return $this->user_type == 1;
    }
    public function categories(){

        return $this->hasMany('App\Category');
    }

    public function posts()
    {
        return $this->hasMany('App\Post');
    }
}
