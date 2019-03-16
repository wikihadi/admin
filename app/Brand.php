<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $guarded=[];

    public function tasks()
    {
        return $this->hasMany('App\Task');
    }

    public function medias()
    {
        return $this->hasMany('App\Media');
    }
}
