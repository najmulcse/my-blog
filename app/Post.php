<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded =[''];

    public function user()
    {
    	return $this->belongsTo('App\User');
    }
    public function category()
    {
    	return $this->belongsTo('App\Category');
    }
    public function postType()
    {
    	return $this->belongsTo('App\PostType','post_type');
    }
    public function contents()
    {
        return $this->hasMany('App\Content');
    }
    
}
