<?php

namespace App\Http\Controllers;

use App\Status;
use App\Task;
use App\TaskOrderUser;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Null_;
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
        $user = Auth::user();
        $myTasksStatus = $user->taskOrder()->get();
        $usersStatus = User::all();
        $statusesToMe = Status::with('user')->where('to_user',$user->id)->orderBy('created_at','DESC')->paginate(5);
        $dateBefore = Carbon::now();

        foreach ($statusesToMe as $key => $loop){
            $loop->jCreated_at = new Verta($loop->created_at);
            $loop->diff = verta($loop->created_at)->formatDifference();
            $loop->diffM = abs(Carbon::parse($loop->created_at)->diffInMinutes($dateBefore, false));


        }

        $statuses = Status::with('task','user')->whereNull('to_user')->orderBy('updated_at','DESC')->paginate(20);
        //$tasks = Task::all();
        return view('statuses.index', compact('statuses','myTasksStatus','usersStatus','statusesToMe'));
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
        $user = Auth::user();
        $request->validate([
            'content'=>'required'
        ]);
        $status = new Status([
            'status'    => $request->get('status'),
            'content'   => $request->get('content'),
            'to_user'   => $request->get('to_user'),
            'task_id'   => $request->get('task_id'),
            'user_id'   => $request->get('user_id'),
            'post_id'   => $request->get('post_id'),
        ]);
        $status->save();

        $taskOrderUser = TaskOrderUser::where('user_id',$request->get('user_id'))->where('task_id',$request->get('task_id'))->first();
        if($request->get('status') == 'comment'){
            $task_id = $request->get('task_id');
            $task = Task::find($task_id);
            $task->increment('commentCount');
        }elseif($request->get('status') == 'end'){
            $taskOrderUser->isDone = 1;
            $taskOrderUser->lastStatus = 3;
            $taskOrderUser->save();
        }elseif($request->get('status') == 'start'){

            $lastStatus = TaskOrderUser::where('lastStatus','2')->where('user_id',$user->id)->first();
            if(!empty($lastStatus)){
                $lastStatus->lastStatus = 1;
                $lastStatus->save();
                $taskOrderUser->lastStatus = 2;
                $taskOrderUser->save();
            }else{
                $taskOrderUser->lastStatus = 2;
                $taskOrderUser->save();
            }

        }

        $inputStatus = $request->get('status');
        $user_id = $request->get('user_id');
        if($inputStatus == 'on' || $inputStatus == 'off' || $inputStatus == 'in' || $inputStatus == 'out' || $inputStatus == 'lunch-start' || $inputStatus == 'lunch-end'){
            $user = User::find($user_id);
            $user->lastStatus = $inputStatus;
            $user->save();
        }

//lastStatus 0 Not yet
//lastStatus 1 workerd not Done
//lastStatus 2 working
//lastStatus 3 Done

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
    public function edit(Request $request, $id)
    {
//        Must Be in everywhere Start
        $user = Auth::user();
        $myTasksStatus = $user->taskOrder()->get();
        $usersStatus = User::all();
        $statusesToMe = Status::with('user')->where('to_user',$user->id)->orderBy('created_at','DESC')->paginate(5);
        $dateBefore = Carbon::now();
        foreach ($statusesToMe as $key => $loop){
            $loop->jCreated_at = new Verta($loop->created_at);
            $loop->diff = verta($loop->created_at)->formatDifference();
            $loop->diffM = abs(Carbon::parse($loop->created_at)->diffInMinutes($dateBefore, false));


        }
//        Must Be in everywhere End

        $user = Auth::user();
        $status = Status::find($id);
        $dateBefore = Carbon::now();
        $diffM = abs(Carbon::parse($status->created_at)->diffInMinutes($dateBefore, false));

        if($status->user_id == $user->id && $diffM <= 5){
            return view('statuses.edit', compact('status','user','myTasksStatus','usersStatus','statusesToMe'));
        }else{
            return redirect()->back();
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Status  $status
     * @return \Illuminate\Http\Response
     */
//    public function update(Request $request,$id)
//    {
//
//        $user = Auth::user();
//        $status = Status::find($id);
//
//        if($request->input('user_id') == $user->id){
//            $status->content = $request->input('content');
//            $status->save();
//
//        }
//
//
//
//
//
//
//
//        return redirect()->back()->with('success');
//    }
    public function update(Request $request, $id)
    {
        $status = Status::findOrFail($id);
        $status->update($request->all());

        return $status;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Status  $status
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $task = Status::find($id);
        $task->delete();

        $task = Task::find($request->get('task_id'));
        $task->decrement('commentCount');

        return redirect()->back()->with('success');
    }


//    public function homeStatusToMe(){
//
//       return $messages = Status::with('user','toUser')->where('to_user', 1)->orWhere('user_id', 1)->orderBy('created_at','DESC')->get();
////        foreach ($messages as $key => $loop) {
////            date_default_timezone_set("Asia/Tehran");
////            $loop->diff = verta($loop->created_at)->formatDifference();
////        }
////
////     return $messages;
//
//    }


    public function addStatusToBox(Request $request){
        Status::create($request->all());
        return(['message' => 'Task Done']);
    }
    public function statusListBox(){
        return Status::where('status','box')->latest()->get();
    }
    public function statusUpdate(Request $request, Status $status){
        $status->status = 'boxed';
        $status->save();
    }
}
