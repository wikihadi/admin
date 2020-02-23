<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    public function u(){
//        $u = auth()->user();
////        $u = ['id'=>1];
//        return $u;
//        return auth()->user();
        return app('Illuminate\Contracts\Auth\Guard')->user();

    }
    public function taskAll(){
        return Task::all();
    }
}
