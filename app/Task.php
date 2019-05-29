<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Task extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $guarded=[];



     public function comments()
        {
            return $this->hasMany('App\Comment');
        }
     public function status()
        {
            return $this->hasMany('App\Status','task_id');
        }
     public function statusInLine()
        {
            return $this->hasMany('App\Status','task_id')->where('status','start')->orWhere('status','pause')->orWhere('status','end')->orderBy('updated_at','desc');
        }
     public function lastStatusOrder()
        {
            return $this->hasMany('App\TaskOrderUser','id','task_id');
        }


    public function lastStatusUser($user_id)
    {
        return $this->hasMany('App\Status','task_id')->wherHas('user_id',$user_id)->orderBy('updated_at','desc')->first();
    }


     public function taskMeters()
        {
            return $this->belongsToMany('App\TaskMeter','task_meters', 'user_id', 'task_id');
        }

     public function medias()
        {
            return $this->hasMany('App\Media');
        }
    public function parentComments()
    {
        return $this->comments()->where('parent_id', 0);
    }
    public function categories()
    {
        return $this->belongsToMany('App\Category', 'category_task');
    }


    public function users()
    {
        return $this->belongsToMany('App\User', 'task_users', 'task_id', 'user_id');
    }

    public function userOrder()
    {
        return $this->belongsToMany('App\User', 'task_order_users', 'task_id', 'user_id')->withPivot('isDone');
    }
    public function brand()
    {
        return $this->belongsTo('App\Brand');
    }
    public function checklists()
    {
        return $this->hasMany('App\Checklist','user_id');
    }


}
