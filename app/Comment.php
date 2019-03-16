<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    protected $guarded=[];


    public function tasks()
    {
        return $this->belongsTo('App\Task');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function medias()
    {
        return $this->hasMany('App\Media');
    }
}
