<?php

namespace App\Http\Controllers;

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

        $test = Status::where('user_id',Auth::id())->where('status','off')->orWhere('status','on')->orderBy('created_at','desc')->first();
        if(empty($test->status) || $test->status == 'on'){
            $off = 0;
        }else{
            $off = 1;
        }
        $v = Verta::now();


        $statusPost = Status::where('status','verifyPost')->where('user_id',$user->id)->where('post_id',15)->get();
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
        $lastMyComments = Status::with('task','user')->whereIn('task_id',$a)->where('status','comment')->orderBy('updated_at','desc')->paginate(5);
        $messages = Status::with('user','toUser')->where('to_user',$user->id)->orWhere('user_id',$user->id)->whereNotNull('to_user')->orderBy('created_at','DESC')->paginate(5);

        return view('home',compact('v','myTasksStatus','usersStatus','statusesToMe','lastStartedStatus','off','read','lastMyTaskStatus','lastMyComments','messages'));
    }



}
