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
    	return $this->belongsTo('App\Category','category_id','id');
    }
    public function postType()
    {
    	return $this->hasOne('App\Posttype','id','post_type');
    }
    public function contents()
    {
        return $this->hasMany('App\Content');
    }
    
}
