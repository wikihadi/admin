<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Fin;
use App\Gallery;
use App\Notifications\messageSent;
use App\Notifications\RepliedToTask;
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
        $statusesToMe = Status::with('user')->whereHas('user')->where('to_user',$user->id)->orderBy('created_at','DESC')->paginate(5);
        $dateBefore = Carbon::now();

        foreach ($statusesToMe as $key => $loop){
            $loop->jCreated_at = new Verta($loop->created_at);
            $loop->diff = verta($loop->created_at)->formatDifference();
            $loop->diffM = abs(Carbon::parse($loop->created_at)->diffInMinutes($dateBefore, false));


        }
        $id=Auth::id();
        if($id == 1 || $id==2){
            $statuses = Status::with('task','user')->whereHas('user')->
            whereNull('to_user')->
            latest()->paginate(20);

        }else{
            $statuses = Status::
            with('task','user')->
            whereHas('user')->
            where('user_id',$id)->
            orWhere('to_user',$id)->
            latest()->
            paginate(10);

        }
        $users = User::all();
        $user = Auth::user();
        $lunch=Status::where('user_id',$user->id)->where('status','lunch-start')->whereDate('created_at',Carbon::today())->count();

        //$tasks = Task::all();
        return view('statuses.index', compact('lunch','statuses','myTasksStatus','usersStatus','statusesToMe','users','user'));
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
        $duration = null;

        $taskOrderUser = TaskOrderUser::where('user_id',$request->get('user_id'))->where('task_id',$request->get('task_id'))->first();
        if($request->get('status') == 'comment'){
            $task_id = $request->get('task_id');
            $task = Task::find($task_id);
            $task->increment('commentCount');
        }elseif($request->get('status') == 'end'){
            $taskOrderUser->isDone = 1;
            $taskOrderUser->lastStatus = 3;
            $taskOrderUser->save();
        }elseif($request->get('status') == 'end-back'){
            $taskOrderUser->isDone = 0;
            $taskOrderUser->lastStatus = 1;
            $taskOrderUser->save();
        }elseif($request->get('status') == 'start'){

            $lastStatus = TaskOrderUser::where('lastStatus','2')->where('user_id',$user->id)->first();

            if(!empty($lastStatus)){
                $lastStatusOther = TaskOrderUser::where('lastStatus','2')->where('user_id',$user->id)->get();
                foreach ($lastStatusOther as $o){
                    $o->lastStatus = 1;
                    $o->save();
                }
                $lastStatus->lastStatus = 1;
                $lastStatus->save();
                $taskOrderUser->lastStatus = 2;
                $taskOrderUser->save();
            }else{
                $lastStatusOther = TaskOrderUser::where('lastStatus','2')->where('user_id',$user->id)->get();
                foreach ($lastStatusOther as $o){
                    $o->lastStatus = 1;
                    $o->save();
                }
                $taskOrderUser->lastStatus = 2;
                $taskOrderUser->save();
            }

        }
        if ($request->get('status') == 'lunch-end'){
            $lunchStart = Status::where('user_id',$user->id)->where('status','lunch-start')->latest()->first();
            $duration=Carbon::now()->diffInMinutes($lunchStart->created_at);
            } elseif ($request->get('status') == 'on'){
            $lunchStart = Status::where('user_id',$user->id)->where('status','off')->latest()->first();
            $duration=Carbon::now()->diffInMinutes($lunchStart->created_at);
            } elseif ($request->get('status') == 'in'){
            $lunchStart = Status::where('user_id',$user->id)->where('status','out')->latest()->first();
            $duration=Carbon::now()->diffInMinutes($lunchStart->created_at);
            }
        $status = new Status([
            'status'    => $request->get('status'),
            'content'   => $request->get('content'),
            'to_user'   => $request->get('to_user'),
            'task_id'   => $request->get('task_id'),
            'user_id'   => $request->get('user_id'),
            'post_id'   => $request->get('post_id'),
            'duration'   => $duration,
        ]);
        $status->save();

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
//        $user->notify(new RepliedToTask($status));
//        Auth::user()->notify(new messageSent($status));
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
    public function update(Request $request,$id)
    {

        $user = Auth::user();
        $status = Status::find($id);

        if($request->input('user_id') == $user->id){
            $status->content = $request->input('content');
            $status->save();

        }







        return redirect()->back()->with('success');
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


    public function addBoxToUsers(Request $request){
            foreach ($request->get('to_user') as $t){
              $status = new Status([
                'status'    => 'box',
                'content'   => $request->get('content'),
                'to_user'   => $t,
                'user_id'   => $request->get('user_id'),
            ]);
            $status->save();
        }
    }
    public function addFin(Request $request){

//        if (isset($_GET['update'])){
        if (isset($_GET['update'])){
            if ($_GET['role']=='admin'){
                $acc_content=$_GET['acc_content'];
                $acc_id=$_GET['u'];
                if($_GET['acc']==true){
                    $state=1;
                }
            }else{
                $acc_id=null;
                $acc_content=null;
            }
            $update = $_GET['update'];
        }else{
            $update = 0;
            $acc_id=null;
            $acc_content=null;
        }
        $user_id = $_GET['u'];
        $brand_id = $_GET['b'];
        $content = $_GET['c'];
        $price = $_GET['p'];
        $subject = $_GET['s'];
        $date = $_GET['date'];

if ($update!=0){
    $newStatus = 'fin-update';
    $newContent = 'ویرایش هزینه توسط کاربر ' . $user_id;
    $fin = Fin::find($update);
    $fin->price=$price;
    $fin->date=$date;
    $fin->content=$content;
    $fin->brand_id=$brand_id;
    $fin->subject=$subject;
    $fin->acc_id=$acc_id;
    $fin->acc_content=$acc_content;
    if (isset($state)){
        $fin->state=$state;
    }
}else{
    $newStatus = 'fin';
    $newContent = 'ثبت هزینه توسط کاربر ' . $user_id;
    $fin = new Fin([
        'price' => $price,
        'date' => $date,
        'content' => $content,
        'user_id' => $user_id,
        'brand_id' => $brand_id,
        'subject' => $subject,
    ]);

}
        $fin->save();

        $status = new Status([
            'status'    => $newStatus,
            'content'   => $newContent,
            'user_id'   => $user_id,
            'fin_id' =>     $fin->id,

        ]);
        $status->save();

        return $fin;
    }
    public function addStatusToBox(Request $request){

        $status = Status::create($request->all());
        $status->ip_address = $request->ip();
        $status->save();
//        $status->notify(new messageSent($status));
        if (!empty($status->task_id)){
            $task_id = $request->get('task_id');
            $user_id = $request->get('user_id');

            $x = TaskOrderUser::where('user_id',$user_id)->where('task_id',$task_id)->first();

            if ($request->get('status') == 'comment'){
                $task = Task::find($task_id);
                $task->increment('commentCount');
            }elseif ($request->get('status') == 'start') {
                $x2 = TaskOrderUser::
                where('user_id',$user_id)->
//                where('task_id',$task_id)->
                where('lastStatus',2)->first();
                $status = new Status([
                    'status'    => 'pause',
                    'content'   => 'توقف کار ' . $x2->task_id,
                    'task_id'   => $x2->task_id,
                    'user_id'   => $user_id,
                ]);
                $status->save();

                $x->lastStatus = 2;
                $orderTaskOther = TaskOrderUser::where('user_id',$user_id)->where('lastStatus',2)->where('task_id','!=',$task_id)->get();
                foreach ($orderTaskOther as $o){
                    $o->lastStatus = 1;
                    $o->save();
                }
            }elseif ($request->get('status') == 'print'){
                $x->lastStatus = 6;
            }elseif ($request->get('status') == 'follow'){
                $x->lastStatus = 5;
            }elseif ($request->get('status') == 'end'){
                $x->lastStatus = 3;
            }elseif ($request->get('status') == 'pending'){
                $x->lastStatus = 4;
            }elseif ($request->get('status') == 'recycle'){
                $x->lastStatus = 1;
            }
            $x->save();

        }



//
//        $user = Auth::user();
//        $orderTask = TaskOrderUser::where('user_id',$user)->where('task_id',$task_id)->first();
//        $orderTask->lastStatus = 2;
//        $orderTask->save();

        return $status;
    }
    public function playTask(){
        $task_id = $_GET['task'];
        $user_id = $_GET['user'];

//        $x2 =       TaskOrderUser::where('user_id',$user_id)->where('lastStatus',2)->first();


            $x =        TaskOrderUser::where('user_id',$user_id)->where('task_id',$task_id)->first();
            $x->lastStatus = 2;
            $x->save();





        $lastStarted=           Status::where('status','start')->where('user_id',$user_id)->latest()->first();
        $status = new Status([
            'status'    => 'start',
            'content'   => 'شروع کار ' . $task_id,
            'task_id'   => $task_id,
            'user_id'   => $user_id,
        ]);
        $status->save();

        $betweenStatus=Status::whereIn('status',['in','on','lunch-end'])->where('user_id',$user_id)->where('created_at','>',$lastStarted->created_at)->sum('duration');
//        if ($betweenStatus>0){
            $duration=Carbon::now()->diffInMinutes($lastStarted->created_at) - $betweenStatus;
//        }else{
//            $duration=Carbon::now()->diffInMinutes($lastStarted->created_at);
//        }

        $status2 = new Status([
            'status'    => 'pause',
            'content'   => 'توقف کار ' . $lastStarted->task_id,
            'task_id'   => $lastStarted->task_id,
            'user_id'   => $user_id,
            'duration'   => $duration,
        ]);

        $status2->save();



            $orderTaskOther = TaskOrderUser::where('user_id',$user_id)->where('lastStatus',2)->where('task_id','!=',$task_id)->get();
            foreach ($orderTaskOther as $o){
                $o->lastStatus = 1;
                $o->save();
            }

        return $betweenStatus;
    }
    public function statusListBox(){

        if (isset($_GET['toid'])) {
            $status = Status::with('user')->whereHas('user')->
            where('status', 'box')->where('to_user', $_GET['toid'])->where('user_id', '!=', $_GET['toid'])
                ->latest()->get();
        }elseif (isset($_GET['fid'])) {
            $status = Status::where('status', 'box')->where('to_user', $_GET['fid'])->where('forcedBox', 1)->latest()->get();
        }elseif (isset($_GET['ID'])) {
            if (isset($_GET['day'])){

                $day = $_GET['day'];
                $dt = Carbon::now()->addDay($day);
                $status = Status::
                    with('user')->whereHas('user')->
                whereDate('created_at',$dt->toDateString())->
                whereIn('status', ['box','boxed'])->
                where('user_id', $_GET['ID'])->
                where('to_user', $_GET['ID'])->
                orWhere('to_user', $_GET['ID'])->
                whereDate('created_at',$dt->toDateString())->
                where('status', 'box')->
                    orderBy('status','asc')->
                latest()->get();
            }else{
                $status = Status::whereIn('status', ['box','boxed'])->where('user_id', $_GET['ID'])->where('to_user', $_GET['ID'])->orWhere('user_id', $_GET['ID'])->where('to_user', null)->where('status', 'box')->orderBy('status','asc')->orderBy('updated_at','desc')->get();
            }
        }elseif (isset($_GET['userPlayId'])) {
            $status = Status::
            where('user_id', $_GET['userPlayId'])->where('status','box-start')->
            orWhere('user_id', $_GET['userPlayId'])->where('status','box-pause')->
            orWhere('user_id', $_GET['userPlayId'])->where('status','box-end')->
            latest()->first();
        }elseif (isset($_GET['archiveBoxUserId'])) {
            $status = Status::
            where('user_id', $_GET['archiveBoxUserId'])->where('status','boxed')->
            latest()->get();
        }elseif (isset($_GET['archiveSentBoxUserId'])) {
            $status = Status::with('toUser')->whereHas('toUser')->where('status','box')->
            where('user_id', $_GET['archiveSentBoxUserId'])->where('to_user','!=',$_GET['archiveSentBoxUserId'])->
            latest()->get();
        }else{
            $status = Status::where('status', 'box')->where('user_id', 0)->latest()->get();
        }
        return $status;
    }
    public function commentList(){
        $id = $_GET['ID'];
        $toUId = $_GET['toUId'];

        if ($toUId == '' || $id == $toUId){
            $data = Status::with('user','toUser')
                ->where('status','status')->where('to_user',$id)
                ->orWhere('user_id',$id)->where('status','status')
                ->whereNotNull('to_user')->orderBy('created_at','DESC')->get();
        }else{
            $data = Status::with('user','toUser')
                ->where('status','status')      ->where('to_user',$id)      ->where('user_id',$toUId)
                ->orWhere('status','status')    ->where('to_user',$toUId)   ->where('user_id',$id)
                ->whereNotNull('to_user')->orderBy('created_at','DESC')->get();
        }
        foreach ($data as $key => $loop) {
            date_default_timezone_set("Asia/Tehran");
            $loop->diff = verta($loop->created_at)->formatDifference();
        }

        return $data;
    }
//    public function statusUpdate(Request $request, Status $status, $id){
//        $status->status = 'boxed';
//        $status->save();
//    }
    public function statusUpdate($id, Request $request)
    {
        $post = Status::find($id);

        $post->update($request->all());

        return response()->json('successfully updated');
    }

    public function userStatusCommentsCount(){
        $data = Status::where('status', 'comment')->where('user_id', $_GET['ID'])->get()->count();
        return $data;

    }
    public function userStatusCommentsToUserCount(){
        $data = Status::where('status', 'status')->where('user_id', $_GET['ID'])->get()->count();
        return $data;

    }
    public function userTasksCount(){
        $data= Task::where('user_id', $_GET['ID'])->get()->count();
        return $data;

    }
    public function userTasksSelf(){
        $data= TaskOrderUser::where('user_id', $_GET['ID'])->get()->count();
        return $data;

    }
    public function userPostVerified(){
        $data= Status::where('user_id', $_GET['ID'])->where('status','verifyPost')->get()->count();
        return $data;

    }
    public function userOffCount(){
        $data= Status::where('user_id', $_GET['ID'])->where('status','off')->get()->count();
        return $data;

    }
    public function userBoxCount(){
        $data= Status::where('user_id', $_GET['ID'])->where('status','box')->get()->count();
        return $data;

    }
    public function userLunchCount(){
        $data= Status::where('user_id', $_GET['ID'])->where('status','lunch-start')->get()->count();
        return $data;
    }
    public function userDaysCount(){
        $days= Status::where('user_id', $_GET['ID'])->where('status','in')->get()->count();
        return $days;

    }
    public function userEndCount(){
        $data= Status::where('user_id', $_GET['ID'])->where('status','end')->get()->count();
        return $data;
    }
    public function allStatics(){
        $userEndCount= Status::where('user_id', $_GET['ID'])->where('status','end')->get()->count();
        $userDaysCount= Status::where('user_id', $_GET['ID'])->where('status','in')->get()->count();
        $userLunchCount= Status::where('user_id', $_GET['ID'])->where('status','lunch-start')->get()->count();
        $userBoxCount= Status::where('user_id', $_GET['ID'])->where('status','box')->get()->count();
        $userOffCount= Status::where('user_id', $_GET['ID'])->where('status','off')->get()->count();
        $userPostVerified= Status::where('user_id', $_GET['ID'])->where('status','verifyPost')->get()->count();
        $userTasksSelf= TaskOrderUser::where('user_id', $_GET['ID'])->get()->count();
        $userTasksCount= Task::where('user_id', $_GET['ID'])->get()->count();
        $userStatusCommentsToUserCount = Status::where('status', 'status')->where('user_id', $_GET['ID'])->get()->count();
        $userStatusCommentsCount = Status::where('status', 'comment')->where('user_id', $_GET['ID'])->get()->count();
        return response()->json([
            'userEndCount' => $userEndCount,
            'userDaysCount' => $userDaysCount,
            'userLunchCount' => $userLunchCount,
            'userBoxCount' => $userBoxCount,
            'userOffCount' => $userOffCount,
            'userPostVerified' => $userPostVerified,
            'userTasksSelf' => $userTasksSelf,
            'userTasksCount' => $userTasksCount,
            'userStatusCommentsToUserCount' => $userStatusCommentsToUserCount,
            'userStatusCommentsCount' => $userStatusCommentsCount
        ]);
    }

    public function allStaticsBoxes(){
        $data= Status::where('user_id', $_GET['ID'])->where('status','box')->get();
        return $data;
    }

//statics

public function statics(){
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
    $users = User::all();
    return view('users.statics', compact('users','myTasksStatus','usersStatus','statusesToMe'));

}

    public function searchTasks(){
        $s = $_GET['s'];
        $u = $_GET['u'];

        if(!empty($s) && strlen($s) > 5){
            $searchValues = preg_split('/\s+/', $s, -1, PREG_SPLIT_NO_EMPTY);
//            if ($u<3||$u==14){
                $tasks = TaskOrderUser::with('task','user','comments')->
//                where('user_id',$u)->
                whereHas('task', function ($q) use ($searchValues) {
                    foreach ($searchValues as $value) {
                        $q->where('title', 'like', "%{$value}%");
                    }
                })->get();
//                $tasks1 = $tasks->groupBy('task_id')->pluck('id')->toArray();
//                $tasks = TaskOrderUser::whereIn('id',$tasks1)->with('task','user','comments')->latest()->get();
//            }else{
//                $tasks = TaskOrderUser::with('task','user','comments')->
//                where('user_id',$u)->
//                whereHas('task', function ($q) use ($searchValues) {
//                    foreach ($searchValues as $value) {
//                        $q->where('title', 'like', "%{$value}%");
//                    }
//                })->get();
//            }

            foreach ($tasks as $key => $loop){
                $users = TaskOrderUser::with('user')->whereHas('user')->where('task_id',$loop->task_id)->pluck('user_id')->toArray();
                $users = User::whereIn('id',$users)->get();
                $loop->users = $users;

//                $dateBefore = Carbon::now();
//
//                foreach ($loop->comments as $key => $loop){
//                    $loop->jCreated_at = new Verta($loop->created_at);
//                    $loop->diff = verta($loop->created_at)->formatDifference();
//                    $loop->diffM = abs(Carbon::parse($loop->created_at)->diffInMinutes($dateBefore, false));
//                }
            }
//            $tasks = Task::where(function ($q) use ($searchValues) {
//                foreach ($searchValues as $value) {
//                    $q->where('title', 'like', "%{$value}%");
//                }
//            })->get();
//            $tasks = Task::where('title', 'like', '%' . $s . '%')->get();

            return $tasks;
        }

    }
    public function fetchTasks(){
            $u = $_GET['u'];
            $el = $_GET['el'];
            $op = $_GET['op'];
            $val = $_GET['val'];
            $ord = $_GET['ord'];
            $ordOp = $_GET['ordOp'];


//        if ($lastStatusOp == 'le'){
//            $lastStatusOp = '<=';
//        }elseif($lastStatusOp == 'be'){
//            $lastStatusOp = '>=';
//        }
        if ($el == 'routine' && !isset($_GET['day'])){
            $tasks = TaskOrderUser::with('task','user','comments')->whereHas('user')->whereHas('task')->
            where('user_id', $u)->
            where('lastStatus','!=', 3)->
            where($el, $op, $val)->
            orderBy($ord , $ordOp)->get();
        }else if ($val == 2){
            $tasks = TaskOrderUser::with('task','user','comments')->whereHas('user')->whereHas('task')->
            where('user_id', $u)->
            where('lastStatus', 1)->
            where('routine', 0)->
            orWhere('lastStatus', 2)->
            where('user_id', $u)->
            where('routine', 0)->
            orderBy('lastStatus','desc')->
            orderBy($ord , $ordOp)->get();
        }else{
            $tasks = TaskOrderUser::with('task','user','comments')->whereHas('user')->whereHas('task')->
            where('user_id', $u)->
            where($el, $op, $val)->
            where('routine', 0)->
            orderBy($ord , $ordOp)->get();
        }
        if (isset($_GET['day'])){
            $day = $_GET['day'];
            $dt = Carbon::now()->addDay($day);
            if ($el != 'routine') {

//            whereDate('created_at',$dt->toDateString())->

                $tasks = TaskOrderUser::where('user_id', $u)
                    ->with('task', 'user', 'startStatuses', 'comments')
                    ->whereHas('user')
                    ->whereHas('task')
                    ->whereHas('startStatuses', function ($q) use ($dt,$u) {
                        $q->whereDate('created_at', $dt->toDateString())->where('user_id',$u);
                    })
                    ->where('user_id', $u)
                    ->where($el, $op, $val)
                    ->where('routine', 0)
                    ->orderBy($ord, $ordOp)->get();
            }elseif($el == 'routine'){


                $tasks = TaskOrderUser::with('task','user','comments','startStatuses')
                    ->whereHas('user')
                    ->whereHas('task')
                    ->whereHas('startStatuses', function ($q) use ($dt) {
                        $q->whereDate('created_at', $dt->toDateString());
                    })
                    ->where('user_id', $u)
                    ->where('lastStatus','!=', 3)->
                where($el, $op, $val)->
                orderBy($ord , $ordOp)->get();
            }
        }
        foreach ($tasks as $key => $loop){
            $users = TaskOrderUser::with('user')->whereHas('user')->where('task_id',$loop->task_id)->pluck('user_id')->toArray();
            $users = User::whereIn('id',$users)->get();
            $loop->users = $users;

            $loop->time = Status::where('task_id',$loop->task_id)->sum('duration');


        }
//        $dateBefore = Carbon::now();
//
//        foreach ($tasks->comments as $key => $loop){
//            $loop->jCreated_at = new Verta($loop->created_at);
//            $loop->diff = verta($loop->created_at)->formatDifference();
//            $loop->diffM = abs(Carbon::parse($loop->created_at)->diffInMinutes($dateBefore, false));
//        }
            return $tasks;

    }
    public function commentFetch(){
        $task_id = $_GET['id'];
        $comments = Status::with('user','gallery')->
        whereIn('status',['comment','new-pic','follow','pending','start','pause','end'])->where('task_id',$task_id)->
        whereHas('user')->
        orderBy('updated_at','desc')->get();
        $dateBefore = Carbon::now();

        foreach ($comments as $key => $loop){
            $loop->jCreated_at = new Verta($loop->created_at);
            $loop->diff = verta($loop->created_at)->formatDifference();
            $loop->diffM = abs(Carbon::parse($loop->created_at)->diffInMinutes($dateBefore, false));
        }
        return $comments;
    }


    public function newStatus($status,$content,$to_user,$task_id,$user_id,$post_id){
        $s = new Status([
            'status'    => $status,
            'content'   => $content,
            'to_user'   => $to_user,
            'task_id'   => $task_id,
            'user_id'   => $user_id,
            'post_id'   => $post_id,
        ]);
        $s->save();
//        Self::newStatus('boxed','test',null,1,null,null);

    }

    public function chartFetch(){
       $lastStartBeforeToday =     Status::with('task')->whereHas('task')->where('user_id',$_GET['ID'])->whereDate('created_at','<', Carbon::today())->whereIn('status', ['start'])->orderBy('created_at','desc')->first();
       $startsBeforeToday =     Status::with('task')->whereHas('task')->where('user_id',$_GET['ID'])->whereDate('created_at','<', Carbon::today())->whereIn('status', ['start'])->orderBy('created_at','desc')->get();
       $startsToday =           Status::with('task')->whereHas('task')->where('user_id',$_GET['ID'])->whereDate('created_at', Carbon::today())->whereIn('status', ['start'])->orderBy('created_at','desc')->get();
//       $starts=                 Status::with('task')->whereHas('task')->where('user_id',$_GET['ID'])->whereIn('status', ['start','end'])->orderBy('created_at','desc')->get();
       $boxesToday =            Status::with('box')->whereHas('box')->where('user_id',$_GET['ID'])->whereDate('created_at', Carbon::today())->whereIn('status', ['box-start','box-pause','box-end'])->orderBy('created_at','desc')->get();
       $boxes =                 Status::with('box')->whereHas('box')->where('user_id',$_GET['ID'])->whereIn('status', ['box-start','box-pause','box-end'])->orderBy('created_at','desc')->get();
       $onOffToday =            Status::where('user_id',$_GET['ID'])->whereIn('status', ['in','out','on','off','lunch-start','lunch-end'])->whereDate('created_at', Carbon::today())->orderBy('created_at','desc')->get();
       $inToday =               Status::where('user_id',$_GET['ID'])->whereIn('status', ['in'])->whereDate('created_at', Carbon::today())->orderBy('created_at','desc')->first();

        return response()->json([
            'startsToday'           => $startsToday,
//            'starts'                => $starts,
            'boxesToday'            => $boxesToday,
            'boxes'                 => $boxes,
            'onOffToday'            => $onOffToday,
            'startsBeforeToday'     => $startsBeforeToday,
            'lastStartBeforeToday'     => $lastStartBeforeToday,
            'inToday'     => $inToday,
        ]);
    }
    public function dayComments(){
        $day = $_GET['day'];
        $u = $_GET['u'];


        $dailyComments =
            Status::
                with('task')->
                whereHas('task')->
                where('user_id',$u)->
                whereDate('created_at', Carbon::now()->addDay($day))->
                whereIn('status', ['comment','start','end'])->
                latest()->get();
        $tasksIds = $dailyComments->pluck('task_id')->unique();
        $tasks = Task::whereIn('id',$tasksIds)->latest()->get();



//        محاسبه کار  شروع شده در روز قبل
        $todayTasksIds =
            Status::
                with('task')->
                whereHas('task')->
                where('user_id',$u)->
                whereDate('created_at', Carbon::now())->
                whereIn('status', ['pause','start','end'])->pluck('task_id');
if (count($todayTasksIds)>0){
    $lastStart='';
}else{
    $lastStart=
        Status::
        with('task')->
        whereHas('task')->
        whereIn('status', ['start'])->
        where('user_id',$u)->
//            whereDate('created_at', '!=' ,Carbon::now())->
        whereNotIn('task_id',$todayTasksIds)->
        latest()->
        first();
}


        foreach ($dailyComments as $key => $loop) {
            date_default_timezone_set("Asia/Tehran");
            $loop->diff = verta($loop->created_at)->formatDifference();
        }
        return response()->json([
            'dailyComments'=> $dailyComments,
            'lastStart'=> $lastStart,
            'tasks'=> $tasks,
        ]);
    }

public function statusesFetch(){
      $u = $_GET['u'];
      $s = $_GET['s'];
      if($s == 1){
          $status = Status::where('user_id',$u)->whereIn('status',['comment'])->latest()->get();

      }elseif ($s == 2){
          $status = Status::where('user_id',$u)->whereIn('status',['start','end'])->latest()->get();

      }elseif ($s == 3){
          $status = Status::where('user_id',$u)->whereIn('status',['box','boxed'])->latest()->get();

      }elseif ($s == 4){
          $status = Status::where('user_id',$u)->whereIn('status',['on','off','lunch-start','lunch-end','in','out'])->latest()->get();

      }else{
          $status = Status::where('user_id',$u)->latest()->get();

      }
    foreach ($status as $key => $loop) {
        date_default_timezone_set("Asia/Tehran");
        $loop->diff = verta($loop->created_at)->formatDifference();
    }
    $todayVisit = Status::where('user_id',$u)->whereIn('status',['visit'])->whereDate('created_at', Carbon::today())->count();
    $user = User::find($u);

    $todayIn= Carbon::today()->hour(8)->minute(30)->second(0);
    $getInToday= Status::where('user_id',$u)->whereIn('status',['visit'])->whereDate('created_at', Carbon::today())->pluck('created_at')->first();

    $lastOut= Status::where('user_id',$u)->whereIn('status',['out'])->whereDate('created_at','<', Carbon::today())->latest()->pluck('created_at')->first();
    $lastOutDate= Status::where('user_id',$u)->whereIn('status',['out'])->whereDate('created_at','<', Carbon::today())->latest()->pluck('created_at')->first();
    $lastDayTimeToOut= $lastOutDate->hour(18)->minute(0)->second(0);

    $lunchStartToday= Status::where('user_id',$u)->whereIn('status',['lunch-start'])->whereDate('created_at', Carbon::today())->pluck('created_at')->first();
    if (!is_null($lunchStartToday)){
        $lunchEndToday= Status::where('user_id',$u)->whereIn('status',['lunch-end'])->whereDate('created_at', Carbon::today())->pluck('created_at')->first();
        $lunchDuration = $lunchStartToday->diffInMinutes($lunchEndToday);
    }else{
        $lunchDuration = null;
    }

    if ($lastOut>$lastOutDate){
        $lastOutDelay=null;
    }else{
        $lastOutDelay=$lastOut->diffInMinutes($lastDayTimeToOut);
    }

    $todayDelay=$todayIn->diffInMinutes($getInToday);


    return response()->json([
        'status'=> $status,
        'todayVisit'=> $todayVisit,
        'user'=> $user,
        'getInToday'=> $getInToday,
        'todayDelay'=> $todayDelay,
        'lastOutDelay'=> $lastOutDelay,
        'lunchDuration'=> $lunchDuration,

    ]);
}


    public function fetchMyTasksLastComments(){
        $order= TaskOrderUser::where('user_id',$_GET['ID'])->get();
        foreach($order as $k => $v) {
            $a[] = $v['task_id'];
        }
        $lastMyComments = Status::
        with('task','user')->
        whereIn('task_id',$a)->where('status','comment')->
        orderBy('updated_at','desc')->
        limit(10)->get();
        foreach ($lastMyComments as $key => $loop) {
            date_default_timezone_set("Asia/Tehran");
            $loop->diff = verta($loop->created_at)->formatDifference();
        }
//        return response()->json([
//            'lastMyComments'           => $lastMyComments,
//        ]);
        return $lastMyComments;
    }
    public function fetchChecklist(){
        $user_id=$_GET['u'];
        $task_id=$_GET['task'];
        $checklist=Status::where('task_id',$task_id)->whereIn('status',['checklist','checked-list'])->latest()->get();
        return $checklist;
    }
    public function allBrands(){
        $brands = Brand::all();
        return $brands;
    }
    public function fetchUsersChatbox(){

        $userID=$_GET['user'];
        $users = User::where('id','!=',$userID)->get();
        foreach ($users as $key => $loop){
            $loop->last_chat = Status::
            whereIn('status',['status','box','boxed'])->
            where('to_user',$userID)->where('user_id',$loop->id)->
            orWhere('user_id',$userID)->where('to_user',$loop->id)->
            whereIn('status',['status','box','boxed'])->
                latest()->first();
        }
        return $users;
    }
    public function fetchUserChatbox(){

        $u=$_GET['u'];
        $uc=$_GET['uc'];
        $chatbox = Status::
        where('to_user',$u)->where('user_id',$uc)->
        orWhere('user_id',$u)->where('to_user',$uc)->
        with(['user','toUser'])->
        latest()->get();
            $userChating=User::find($uc);
        foreach ($chatbox as $key => $loop){
            $loop->jCreated_at = new Verta($loop->created_at);
            $loop->diff = verta($loop->created_at)->formatDifference();
        }
        return response()->json([
            'userChating' => $userChating,
            'chatbox' => $chatbox,

        ]);
    }
    public function chatboxFrmConfirm(Request $request)
    {
        $status = new Status([
            'status'    => $request->get('status'),
            'content'   => $request->get('content'),
            'user_id'   => $request->get('user'),
            'to_user'   => $request->get('toUser'),
        ]);
        $status->save();

//        $request->validate([
//            'pic' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5000',
//            'content'=> 'required'
//        ]);
        if ($request->pic!=null){
            $imageName = 'chatbox'.time().'.'.$request->pic->getClientOriginalExtension();
//            $request->pic->move(public_path('storage/uploads/chatbox'), $imageName);
            $request->pic->storeAs('uploads/chatbox', $imageName);

//            $gallery = new Gallery([
//                'content'=> $request->get('content'),
//                'user_id'=> $request->get('user'),
//                'chatbox_id'=> $status->id,
//                'pic'=>$imageName,
//            ]);
//            $gallery->save();
            $status->pic = $imageName;
            $status->save();
        }

//        if ($request->get('status')){
//            $statusBox = 'status';
//        }else{
//            $statusBox = 'box';
//        }
//        $status = new Status([
//            'price' => $request->price,
//            'date' => $request->date,
//            'user_id' => $request->user,
//            'subject' => $request->subject,
//            'brand_id' => $request->brand,
//            'content' => $request->contentFin,
//        ]);
////        $status->image=$imageName;
//        $status->save();




//        if(!empty($request->pic)) {
//            $picName = 'gallery' . time() . '.' . request()->pic->getClientOriginalExtension();
//            $request->pic->storeAs('uploads/gallery', $picName);
//            $gallery->pic = $picName;
//        }
        return response()->json(['success'=>$request->get('pic')]);
    }
    public function taskAdminAPI(){
        if (isset($_GET['tasks'])&&$_GET['tasks']==1) {
                if (isset($_GET['minus']) && $_GET['minus'] == 1) {
                    $statuses = Task::where('cost', -1)->get();
                } elseif (isset($_GET['payOk']) && $_GET['payOk'] == 1) {
                    $statuses = Task::where('payOK', 1)->where('paid', 0)->get();
                } elseif (isset($_GET['paid']) && $_GET['paid'] == 1) {
                    $statuses = Task::where('paid', 1)->get();
                } else {
                    if (isset($_GET['role'])&&$_GET['role']==1) {
                        $statuses = Task::where('cost', '>=', 0)->where('payOK', 0)->where('paid', 0)->get();
                    }elseif (isset($_GET['role'])&&$_GET['role']==2){
                        $statuses = Task::where('cost', '>=', 0)->where('payOK', 1)->where('paid', 0)->get();
                    }elseif (isset($_GET['role'])&&$_GET['role']==3){
                        $statuses = Task::where('cost', '>=', 0)->where('payOK', 0)->where('paid', 0)->get();
                    }
                }


        }elseif(isset($_GET['taskId'])&&isset($_GET['cost'])){
            $task = Task::find($_GET['taskId']);
            $task->cost=$_GET['cost'];
            $task->save();
            $statuses = Task::where('id' , $_GET['taskId'])->get();
            $s = new Status([
                'status'    => 'finUp',
                'content'   => 'finUp' . $_GET['cost'],
                'task_id'   => $_GET['taskId'],
                'user_id'   => $_GET['userId'],
            ]);
            $s->save();
        }else{


//        $statuses = Status::whereIn('status',['end','start','print','follow','pending'])->orderBy('updated_at','desc')->with('user','task')->whereHas('task')->limit(50)->get();
//        foreach ($statuses as $key => $loop) {
//            if ($loop->status == 'end'){
//                $loop->statusFa = 'پایان کار';
//                $loop->bg = 'table-dark';
//            }elseif ($loop->status == 'start'){
//                $loop->statusFa = 'شروع کار';
//                $loop->bg = 'table-success';
//            }elseif ($loop->status == 'print'){
//                $loop->statusFa = 'ورود به فاز چاپ';
//                $loop->bg = 'table-warning';
//            }elseif ($loop->status == 'pause'){
//                $loop->statusFa = 'توقف کار';
//                $loop->bg = 'table-danger';
//            }elseif ($loop->status == 'follow'){
//                $loop->statusFa = 'فاز پیگیری کار';
//                $loop->bg = 'table-warning';
//            }elseif ($loop->status == 'pending'){
//                $loop->statusFa = 'تعلیق';
//                $loop->bg = 'table-light';
//            }
//        }

        }
        foreach ($statuses as $key => $loop) {
            $loop->jd = verta($loop->updated_at)->formatJalaliDatetime();
            $loop->diff = verta($loop->updated_at)->formatDifference();
            $loop->costc = number_format($loop->cost);
        }

        return $statuses;
    }
    public function taskEndAdminAPI(){
        $task = Task::find($_GET['task_id']);
        return $task;
    }
    public function taskAccAdminAPI(){
        $task = Task::find($_GET['task_id']);
        if ($_GET['acc']==1){
            $task->payOK=1;
        }elseif($_GET['acc']==2){
            $task->paid=1;
        }
        $task->save();
        $s = new Status([
            'status'    => 'finACC',
            'content'   => 'finACC' . $_GET['acc'],
            'task_id'   => $_GET['task_id'],
            'user_id'   => $_GET['userId'],
        ]);
        $s->save();


        return $task;
    }
    public function deleteStatus(){
        $id=$_GET['id'];
        $status = Status::find($id);

        $s = new Status([
            'status'    => 'DeleteStatus',
            'content'   => 'Status deleted: ' . $status->content . ' written by user: ' . $status->user_id . ' deleted by: ' . $_GET['user'],
            'task_id'   => $status->task_id,
            'user_id'   => $_GET['user'],
        ]);
        $status->delete();
        $s->save();
    }
}
