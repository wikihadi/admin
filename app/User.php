<?php

namespace App;

use NotificationChannels\Gcm\GcmChannel;
use NotificationChannels\Gcm\GcmMessage;
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

    public function via($notifiable)
    {
        return [GcmChannel::class];
    }

    public function toGcm($notifiable)
    {
        return GcmMessage::create()
            ->title('Account approved')
            ->message("Your {$notifiable->service} account was approved!");
    }
    public function routeNotificationForGcm()
    {
        return $this->gcm_token;
    }
//    public function via($notifiable)
//    {
//        return [OneSignalChannel::class];
//    }
//
//    public function toOneSignal($notifiable)
//    {
//        return OneSignalMessage::create()
//            ->subject("Your {$notifiable->service} account was approved!")
//            ->body("Click here to see details.")
//            ->url('http://onesignal.com')
//            ->webButton(
//                OneSignalWebButton::create('link-1')
//                    ->text('Click here')
//                    ->icon('https://upload.wikimedia.org/wikipedia/commons/4/4f/Laravel_logo.png')
//                    ->url('http://laravel.com')
//            );
//    }
//
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
    public function status()
    {
        return $this->hasMany('App\Status', 'user_id');
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
        return $this->belongsToMany('App\Task', 'task_order_users', 'user_id', 'task_id')->orderBy('order_column','asc')->wherePivot('isDone',0);//->where('order_column','!=',-1);
    }
    public function taskOrderDone()
    {
        return $this->belongsToMany('App\Task', 'task_order_users', 'user_id', 'task_id')->orderBy('updated_at','desc')->wherePivot('isDone',1);//->where('order_column','!=',-1);
    }
    public function taskOrderLatest()
    {
        return $this->belongsToMany('App\Task', 'task_order_users', 'user_id', 'task_id');//->where('order_column','!=',-1);
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

    public function lastStatusUser()
    {
        return $this->hasMany('App\Status','user_id');
    }
    public function usersInTasks()
    {
        return $this->hasMany('App\TaskOrderUser','user_id','id');
    }
//    public function taskMeters()
//    {
//        return $this->belongsToMany('App\TaskMeter','task_meters', 'user_id', 'task_id');
//    }


}
