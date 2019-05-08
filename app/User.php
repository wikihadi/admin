<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Passport\HasApiTokens;


class User extends Authenticatable
{
    use HasRoles;
   // protected $guard_name = 'web'; // or whatever guard you want to use

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','phone', 'experience',
    ];
//    protected $guarded=[];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

//    public function setPasswordAttribute($password)
//    {
//        $this->attributes['password'] = bcrypt($password);
//    }
//    public function setPasswordAttribute($password)
//    {
//        $this->attributes['password'] = \Hash::make($password);
//    }
    public function tasks()
    {
        return $this->belongsToMany('App\Task', 'task_users', 'user_id', 'task_id');
    }
    public function taskOrder()
    {
        return $this->belongsToMany('App\Task', 'task_order_users', 'user_id', 'task_id')->orderBy('order_column','asc');//->where('order_column','!=',-1);
    }
    public function taskNotOrder()
    {
        return $this->belongsToMany('App\Task', 'task_order_users', 'user_id', 'task_id')->orderBy('order_column','asc');//->where('order_column','!=',-1);
    }
    public function medias()
    {
        return $this->hasMany('App\Media');
    }
    public function verify()
    {
        return $this->belongsToMany(Post::class, 'post_verifies', 'user_id', 'post_id')->withTimeStamps();
    }
    public function taskMeters()
    {
        return $this->belongsToMany('App\TaskMeter','task_meters', 'user_id', 'task_id');
    }


}
