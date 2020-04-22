<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Posts extends Model
{
    use SoftDeletes;

    protected $fillable = ['judul', 'category_id','content', 'gambar','slug','users_id'];

    public function Category()
    {
        //belong to berfungsi untuk relasi tabel one to many
        return $this->belongsTo('App\Category');
    }

    public function posts_tags(){
    	return $this->belongsTo('App\Posts_tags');
    }

    public function tags()
    {
        //belong to berfungsi untuk relasi tabel many to many
        return $this->belongsTo('App\Tags');
    }

    public function users()
    {
        //belong to berfungsi untuk relasi tabel many to many
        //didalam app jika nama fil tidak dideteksi maka deteksikan file dengan menambah nama field dan dengan dield yang berelasi ('app', 'nama field', 'kefield mana')
        return $this->belongsTo('App\user');
    }
}
