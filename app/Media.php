<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $guarded=[];

    public function task()
    {
        return $this->belongsTo('App\Task');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function comment()
    {
        return $this->belongsTo('App\Comment');
    }
    public function brand()
    {
        return $this->belongsTo('App\Brand');
    }


}
