<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fin extends Model
{
    use SoftDeletes;
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
