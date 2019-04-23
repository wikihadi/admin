<?php

namespace App\Http\Controllers;

use App\Task;
use App\TaskMeter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskMeterController extends Controller
{
    public function start($id){
        $user = Auth::user();
        $taskMeter = new TaskMeter([
            'user_id' => $user->id,
            'task_id' => $id,
        ]);
        $taskMeter->save();
        return back();


    }
    public function end($id){
        $user = Auth::user();
        $taskMeter = new TaskMeter([
            'user_id' => $user->id,
            'task_id' => $id,
            'end' => 1
        ]);
        $taskMeter->save();
        return back();

    }

}
