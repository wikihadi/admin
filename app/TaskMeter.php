<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskMeter extends Model
{
    protected $guarded=[];

    public function tasks()
    {
        return $this->belongsToMany('App\Task', 'task_meters');
    }
    public function users()
    {
        return $this->belongsToMany('App\User', 'task_meters');
    }
}
