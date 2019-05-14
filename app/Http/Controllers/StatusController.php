<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Status;
use App\Task;
use Illuminate\Http\Request;
use Verta;

class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {

        $request->validate([
            'content'=>'required'
        ]);
        $status = new Status([
            'status'    => $request->get('status'),
            'content'   => $request->get('content'),
            'to_user'   => $request->get('to_user'),
            'task_id'   => $request->get('task_id'),
            'user_id'   => $request->get('user_id'),
        ]);
        $status->save();


        $task_id = $request->get('task_id');
        if(!empty($task_id)){
            $task = Task::find($task_id);
            $task->increment('commentCount');
        }




        return back()->with('success', 'Done');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Status  $status
     * @return \Illuminate\Http\Response
     */
    public function show(Status $status)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Status  $status
     * @return \Illuminate\Http\Response
     */
    public function edit(Status $status)
    {
//        $user = Auth::user();
//        $myTasksStatus = $user->taskOrder()->where('isDone',0)->get();
//        $usersStatus = User::all();
//        $statusesToMe = Status::with('user')->where('to_user',$user->id)->orderBy('created_at','DESC')->paginate(5);
//        $dateBefore = Carbon::now();
//
//        foreach ($statusesToMe as $key => $loop){
//            $loop->jCreated_at = new Verta($loop->created_at);
//            $loop->diff = verta($loop->created_at)->formatDifference();
//            $loop->diffM = abs(Carbon::parse($loop->created_at)->diffInMinutes($dateBefore, false));
//
//
//        }
//
//        $user = Auth::user();
//        $comment = Comment::find($id);
//        $dateBefore = Carbon::now();
//        $diffM = abs(Carbon::parse($comment->created_at)->diffInMinutes($dateBefore, false));
//
//        if($comment->user_id == $user->id && $diffM <= 5){
//
//
//
//            return view('comments.edit', compact('comment','user','myTasksStatus','usersStatus','statusesToMe'));
//
//        }else{
//            return redirect()->back();
//        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Status  $status
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Status $status)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Status  $status
     * @return \Illuminate\Http\Response
     */
    public function destroy(Status $status)
    {
        //
    }
}
