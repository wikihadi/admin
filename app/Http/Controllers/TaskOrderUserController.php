<?php

namespace App\Http\Controllers;

use App\TaskOrderUser;
use App\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Validator;
use Response;

class TaskOrderUserController extends Controller
{
    public function __construct()
    {
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function taskIsDone(){
        $id = $_GET['id'];
        $task= Task::find($id);
        $task->isDone=1;
        $task->save();
        return Task::where('isDone','!=',1)->orderBy('orderTask','asc')->latest()->with('userOrder','lastStatusAllUser')->get();


    }

    public function index()
    {
//
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
//
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {

}

    public function updateRoutine($id)
    {

        $order = TaskOrderUser::find($id);
        $t = $order->routine;

        if($t == 0)
        {
            $t = 1;
        }else{
            $t = 0;
        }
        $order->routine = $t;
        $order->save();
        return back();


    }
    public function updateAll(Request $request)
    {


        $taskss = Task::all();
        foreach ($taskss as $t){
            $id = $t->id;
            foreach ($request->order as $orderFrontEnd){
                if($orderFrontEnd['id'] == $id){
                    $t->update(['orderTask' => $orderFrontEnd['orderTask']]);
                }
            }
        }
        return response('Updated.', 200);

    }




    public function destroy(Request $request,$id)
    {
        //
    }


}

