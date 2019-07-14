<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class TaskOrderUser extends Model
{
    protected $guarded=[];


    public function task(){
        return $this->hasOne('App\Task','id','task_id');
    }
    public function user(){
        return $this->hasOne('App\User','id','user_id')->select('id','name','avatar','lastStatus');
    }
    public function statuses(){
        return $this->hasMany('App\Status','id','user_id');
    }
    public function startStatuses(){
        return $this->hasMany('App\Status','task_id','task_id')->whereIn('status',['start','comment','pause','end']);
    }
    public function comments(){
        return $this->hasMany('App\Status','task_id','task_id')->with('user')->where('status','comment')->latest();
    }
}
