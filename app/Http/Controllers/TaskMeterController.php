<?php

namespace App\Http\Controllers;

use App\Task;
use App\TaskMeter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskMeterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        date_default_timezone_set("Asia/Tehran");


    }
    public function start($id){
        $isUser = 0;
        $user = Auth::user();
        $taskMeter = TaskMeter::where('user_id', $user->id)->orderBy('created_at', 'DESC')->first();
        if(isset($taskMeter) && $taskMeter->end == 1 || !isset($taskMeter)){
        $task = Task::find($id);
        $teams = $task->users()->where('task_id',$id)->get();
        foreach ($teams as $team){
            if($team->id == $user->id){
                $isUser = 1;
            }
        }
        if(isset($isUser) && $isUser == 1){

            $taskMeter = new TaskMeter([
                'user_id' => $user->id,
                'task_id' => $id,
            ]);
            $taskMeter->save();
        }
        }
        return back();


    }
    public function end($id){
        $isUser = 0;
        $user = Auth::user();

        $task = Task::find($id);
        $teams = $task->users()->where('task_id',$id)->get();
        foreach ($teams as $team){
            if($team->id == $user->id){
                $isUser = 1;
            }
        }
            if(isset($isUser) && $isUser == 1){
                $taskMeter = new TaskMeter([
                    'user_id' => $user->id,
                    'task_id' => $id,
                    'end' => 1
                ]);
                $taskMeter->save();

            }




        return back();

    }

}
