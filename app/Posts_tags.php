<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Posts_tags extends Model
{

    // public function Category()
    // {
    //     //belong to berfungsi untuk relasi tabel one to many
    //     return $this->belongsTo('App\Category');
    // }

    public function tags()
    {
        //belong to berfungsi untuk relasi tabel one to many
        return $this->belongsTo('App\Tags');
    }

    public function posts(){
    	return $this->belongsTo('App\Posts');
    }


}
