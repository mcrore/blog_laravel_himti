<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tags extends Model
{
    protected $fillable = ['name', 'slug'];

    public function posts(){
    	return $this->belongsToMany('App\Posts');
    }

    public function posts_tags(){
    	return $this->hasMany('App\Posts_tags');
    }

    public function getRouteKeyName()
	{
	    return 'slug';
	}



}
