<?php

namespace App\Http\Controllers;

use App\Status;
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

        
        return view('home',compact('v','myTasksStatus','usersStatus','statusesToMe','lastStartedStatus','off','read'));
    }



}
