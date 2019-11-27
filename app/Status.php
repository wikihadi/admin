<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $guarded=[];
    public function user()
    {
        return $this->belongsTo('App\User')->select('name','id','avatar');
    }
    public function toUser()
    {
        return $this->belongsTo('App\User','to_user','id')->select('name','id','avatar');
    }
    public function usersOn()
    {
        return $this->belongsTo('App\User','user_id','id');
    }
    public function task()
    {
        return $this->belongsTo('App\Task','task_id','id')->select('title','id','cost');
    }
    public function gallery()
    {
        return $this->belongsTo('App\Gallery','gallery_id','id');
    }
    public function box()
    {
        return $this->belongsTo('App\Status','re_id','id');
    }
}
