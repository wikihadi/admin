<?php

namespace App\Http\Controllers;

use App\Status;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Task;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Verta;


class ProfileController extends Controller
{
    public function __construct(){
        $this->middleware('auth');

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function profile()
    {
        $user = Auth::user();
        $myTasksStatus = $user->taskOrder()->where('isDone',0)->get();
        $usersStatus = User::all();
        $statusesToMe = Status::with('user')->where('to_user',$user->id)->orderBy('created_at','DESC')->paginate(5);
        $dateBefore = Carbon::now();

        foreach ($statusesToMe as $key => $loop){
            $loop->jCreated_at = new Verta($loop->created_at);
            $loop->diff = verta($loop->created_at)->formatDifference();
            $loop->diffM = abs(Carbon::parse($loop->created_at)->diffInMinutes($dateBefore, false));


        }

        $tasks = $user->tasks()->paginate(5);
        $myTasks = Task::where('user_id', $user);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
        $my = Status::with('user')->where('user_id',$user->id)->orderBy('created_at','DESC')->get();
        foreach ($my as $key => $loop){
            $loop->jCreated_at = new Verta($loop->created_at);
            $loop->diff = verta($loop->created_at)->formatDifference();
            $loop->diffM = abs(Carbon::parse($loop->created_at)->diffInMinutes($dateBefore, false));


        }
        $myActivities = Status::with('user')->where('user_id',$user->id)->where('status','end')->orWhere('status','start')->orWhere('status','off')->orderBy('created_at','DESC')->get();
        $myStatuses = Status::with('user')->where('to_user',$user->id)->orderBy('created_at','DESC')->paginate(25);
        foreach ($myStatuses as $key => $loop){
            $loop->jCreated_at = new Verta($loop->created_at);
            $loop->diff = verta($loop->created_at)->formatDifference();
            $loop->diffM = abs(Carbon::parse($loop->created_at)->diffInMinutes($dateBefore, false));


        }
        $lastStartedStatus = Status::with('user')->where('user_id',$user->id)->where('status','start')->orWhere('status','end')->orderBy('created_at','desc')->first();

        return view('users.profile',compact('user','roles','userRole','tasks','myTasks','myTasksStatus','usersStatus','statusesToMe','my','myStatuses','myActivities','lastStartedStatus'));

    }
    public function update_avatar(Request $request){















        $request->validate([
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required',
            'password' => 'same:confirm-password'
        ]);



        $user = Auth::user();
        $user->name = $request->get('name');
        $user->experience = $request->get('experience');
        if(!empty($request->avatar)) {
            $avatarName = $user->id . '_avatar' . time() . '.' . request()->avatar->getClientOriginalExtension();
            $request->avatar->storeAs('avatars', $avatarName);
            $user->avatar = $avatarName;
        }
        if(!empty($request->password)){
            $request->password = Hash::make($request->password);
            $user->password = $request->password;
        }


        $user->save();







        return redirect()->back()->with('success');

    }
}
