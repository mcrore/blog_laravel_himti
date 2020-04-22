<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Leaders extends Model
{
    protected $fillable = ['nama', 'periode','angkatan','keterangan','foto'];
}
