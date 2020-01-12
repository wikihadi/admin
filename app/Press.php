<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Press extends Model
{
    protected $guarded=[];

    public function options()
    {
        return $this->belongsToMany('App\PressOption', 'presses_link_options', 'press_id', 'press_options_id')->withPivot('type');
    }
}
