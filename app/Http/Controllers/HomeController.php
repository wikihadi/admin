<?php

namespace App\Http\Controllers;

use App\Events\ArticleEvent;
use App\Status;
use App\TaskOrderUser;
use App\User;
use Carbon\Carbon;
use Hekmatinasser\Verta\Verta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $myTasksStatus = $user->taskOrder()->get();
        $usersStatus = User::all();
        $lastStartedStatus = Status::with('user')->where('user_id',$user->id)->where('status','start')->orWhere('status','end')->orderBy('created_at','desc')->first();


        $statusesToMe = Status::with('user')->where('to_user',$user->id)->orderBy('created_at','DESC')->paginate(5);
        $dateBefore = Carbon::now();

        foreach ($statusesToMe as $key => $loop){
            $loop->jCreated_at = new Verta($loop->created_at);
            $loop->diff = verta($loop->created_at)->formatDifference();
            $loop->diffM = abs(Carbon::parse($loop->created_at)->diffInMinutes($dateBefore, false));


        }


        $v = Verta::now();


        $statusPost = Status::where('status','verifyPost')->where('user_id',$user->id)->where('post_id',16)->get();
        if (count($statusPost) == 0){
            $read = 0;
        }else{
            $read = 1;
        }
        $lastMyTaskStatus = Status::with('task')->where('user_id',$user->id)->where('status','start')->orderBy('updated_at','desc')->paginate(5);
        $order= TaskOrderUser::where('user_id',$user->id)->get();
        foreach($order as $k => $v) {
            $a[] = $v['task_id'];
        }
        $lastMyComments = Status::where('user_id',$user->id);
        if(isset($a)){
            $lastMyComments = Status::with('task','user')->whereIn('task_id',$a)->where('status','comment')->orderBy('updated_at','desc')->paginate(5);

        }
        $messages = Status::with('user','toUser')->where('to_user',$user->id)->orWhere('user_id',$user->id)->whereNotNull('to_user')->orderBy('created_at','DESC')->paginate(5);
        $users = User::all();
        $lastComments = Status::with('task','user')->whereHas('user')->whereHas('task')->whereNotNull('task_id')->where('status','comment')->orderBy('updated_at','desc')->paginate(10);
        $currentJobs = TaskOrderUser::with('task','user')->whereHas('user')->whereHas('task')->where('lastStatus','2')->orderBy('updated_at','desc')->get();
        $orderRoutine = TaskOrderUser::with('task','user')->where('user_id',$user->id)->whereHas('task')->where('isDone',0)->where('routine',1)->orderBy('updated_at','desc')->paginate(5);
        $orderCurrent = TaskOrderUser::with('task','user')->where('user_id',$user->id)->whereHas('task')->where('isDone',0)->where('routine',0)->where('lastStatus',1)->orderBy('updated_at','desc')->paginate(4);
        $myOrderCurrent = TaskOrderUser::with('task')->where('user_id',$user->id)->whereHas("task", function($q){$q->where("routine","=","0");})->where('lastStatus',2)->first();
        $orderFuture = TaskOrderUser::with('task','user')->where('user_id',$user->id)->whereHas('task')->where('isDone',0)->where('routine',0)->where('lastStatus',0)->orderBy('updated_at','desc')->paginate(5);
//        $userTimeIn = Status::whereDate('created_at', Carbon::today())->where('user_id',$user->id)->where('status','in')->orderBy('created_at','desc')->first();
//        $userTimeIn = Carbon::parse($userTimeIn->created_at);
//        $userTimeIn = new Verta($userTimeIn);

        foreach ($users as $key => $loop) {
            date_default_timezone_set("Asia/Tehran");
            $loop->diff = verta($loop->created_at)->formatDifference();
        }
        foreach ($lastMyComments as $key => $loop) {
            date_default_timezone_set("Asia/Tehran");
            $loop->diff = verta($loop->created_at)->formatDifference();
        }
        foreach ($lastComments as $key => $loop) {
            date_default_timezone_set("Asia/Tehran");
            $loop->diff = verta($loop->created_at)->formatDifference();
        }
        foreach ($messages as $key => $loop) {
            date_default_timezone_set("Asia/Tehran");
            $loop->diff = verta($loop->created_at)->formatDifference();
        }

        return view('home',compact('user','myOrderCurrent','orderFuture','orderCurrent','orderRoutine','currentJobs','lastComments','users','v','myTasksStatus','usersStatus','statusesToMe','lastStartedStatus','read','lastMyTaskStatus','lastMyComments','messages'));
    }



}
