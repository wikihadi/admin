<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskOrderUser extends Model
{
    protected $guarded=[];


    public function task(){
        return $this->hasOne('App\Task','id','task_id');
    }
    public function user(){
        return $this->hasOne('App\User','id','user_id')->select('id','name','avatar');
    }
    public function statuses(){
        return $this->hasMany('App\Status','id','user_id');
    }
}
