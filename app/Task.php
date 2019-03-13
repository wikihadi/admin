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
    public function brand()
    {
        return $this->belongsTo('App\Brand');
    }


}
