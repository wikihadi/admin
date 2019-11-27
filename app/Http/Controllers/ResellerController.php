<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Task;
use Hekmatinasser\Verta\Verta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResellerController extends Controller
{

    public function main(){
        $brands = Brand::all();
        return view('reseller.main',compact('brands'));
    }
    public function resellerFetchTasks(){
        $user_id = $_GET['userId'];
        $tasks = Task::where('reseller_id',$user_id)->select('id','title','reseller_state','created_at')->latest()->get();
        foreach ($tasks as $key => $loop){
            $loop->jd = verta($loop->created_at)->formatJalaliDatetime();
            $loop->diff = verta($loop->created_at)->formatDifference();
        }
        if ($_GET['taskId']>0){
            $item = Task::find($_GET['taskId']);
            $item->jd = verta($item->created_at)->formatJalaliDatetime();
            $item->diff = verta($item->created_at)->formatDifference();
        }else{
            $item=0;
        }

        $tasksCount1 = $tasks->whereIn('reseller_state',[1,2,3,4,5,6,7])->count();
        $tasksCount2 = $tasks->where('reseller_state',9)->count();
        $tasksCount3 = $tasks->where('reseller_state',10)->count();
        return response()->json([
            'selectedTask'  => $item,
            'tasks'         => $tasks,
            'tasksCount1'   => $tasksCount1,
            'tasksCount2'   => $tasksCount2,
            'tasksCount3'   => $tasksCount3,

        ]);
    }
    public function addResellerTask(Request $request){
        $task = new Task([
            'title' => $request->get('title'),
            'content'=> $request->get('content'),
            'reseller_id'=> Auth::id(),
            'reseller_state'=> 1,
            'material'=> $request->get('material'),
            'dx'=> $request->get('dx'),
            'dy'=> $request->get('dy'),
            'dz'=> $request->get('dz'),
            'dDesc'=> $request->get('dDesc'),
            'subject'=> 'reseller',
            'user_id'=> Auth::id()
        ]);
        $task->save();
        return back();
    }
}
