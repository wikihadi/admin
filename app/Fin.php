<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fin extends Model
{
    protected $guarded=[];
    public function user()
    {
        return $this->belongsTo('App\User')->select('name','id','avatar');
    }
    public function brand()
    {
        return $this->belongsTo('App\Brand');
    }
}
