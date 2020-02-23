<?php

namespace App\Http\Controllers;

use App\Category;
use App\Checklist;
use App\Media;
use App\Status;
use App\TaskOrderUser;
use App\TaskUser;
use App\User;
use App\Task;
use App\Brand;
use DateTime;
use Illuminate\Support\Arr;
use Verta;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;


class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

//        $this->middleware('permission:task-list');
//        $this->middleware('permission:task-create', ['only' => ['create','store']]);
//        $this->middleware('permission:task-edit', ['only' => ['edit','update']]);
//        $this->middleware('permission:task-delete', ['only' => ['destroy']]);
    }




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

        $users = User::all();
        $usersInTasks = TaskUser::all();

        if(isset($_GET['sort']) && $_GET['sort'] == 'done'){
            $order = TaskOrderUser::with('task','user')->whereHas('task')->whereHas('user')->where('user_id',$user->id)->where('isDone',1)->where('routine',0)->orderBy('order_column','asc')->paginate(1000);
        }elseif(isset($_GET['sort']) && $_GET['sort'] == 'latest'){
            $order = TaskOrderUser::with('task','user')->whereHas('task')->whereHas('user')->where('user_id',$user->id)->where('isDone',0)->where('routine',0)->orderBy('updated_at','desc')->paginate(1000);
        }elseif(isset($_GET['sort']) && $_GET['sort'] == 'routine'){
            $order = TaskOrderUser::with('task','user')->whereHas('task')->whereHas('user')->where('user_id',$user->id)->where('isDone',0)->where('routine',1)->orderBy('order_column','asc')->paginate(1000);
        }else{
            $order = TaskOrderUser::with('task','user')->whereHas('task')->whereHas('user')->where('user_id',$user->id)->where('isDone',0)->where('routine',0)->orderBy('order_column','asc')->paginate(10);
        }
        $orderRoutine = TaskOrderUser::with('task','user')->whereHas('task')->whereHas('user')->where('user_id',$user->id)->where('isDone',0)->where('routine',1)->orderBy('order_column','asc')->get();
        $order0 = TaskOrderUser::with('task','user')->whereHas('task')->whereHas('user')->where('user_id',$user->id)->where('lastStatus',0)->where('routine',0)->orderBy('order_column','asc')->get();
        $order1 = TaskOrderUser::with('task','user')->whereHas('task')->whereHas('user')->where('user_id',$user->id)->whereIn('lastStatus',[1,2])->where('routine',0)->orderBy('order_column','asc')->get();
        $order012 = TaskOrderUser::with('task','user')->whereHas('task')->whereHas('user')->where('user_id',$user->id)->whereIn('lastStatus',[0,1,2])->where('routine',0)->orderBy('order_column','asc')->get();
        $order3 = TaskOrderUser::with('task','user')->whereHas('task')->whereHas('user')->where('user_id',$user->id)->where('lastStatus',3)->where('routine',0)->orderBy('order_column','asc')->paginate(20);

        foreach ($orderRoutine as $key => $loop) {
            $v = new Verta($loop->task->startDate);
            $loop->task->jStart = $v->year . "/" . $v->month . "/" . $v->day;
            $v = new Verta($loop->task->deadline);
            $loop->task->jEnd = $v->year . "/" . $v->month . "/" . $v->day;

            date_default_timezone_set("UTC");
            $loop->task->pastOr = Carbon::now()->diffInSeconds($loop->task->startDate, false);

            date_default_timezone_set("Asia/Tehran");
            $loop->task->nowt = "The time is " . date("h:i:sa");
            $loop->task->rightNow = Carbon::now()->diffInMinutes($loop->task->deadline, false);
            $loop->task->diffDead = verta($loop->task->deadline)->formatDifference();
            $loop->task->passNow = abs(Carbon::now()->diffInDays($loop->task->startDate, false));
            $loop->task->passNowHours = abs(Carbon::now()->diffInMinutes($loop->task->startDate, false));
            $loop->task->diffDate = abs(Carbon::parse($loop->task->startDate)->diffInMinutes($loop->task->deadline, false)) + 1;
            $loop->task->diffdiff = (($loop->task->passNowHours) * 100) / ($loop->task->diffDate);
            $loop->task->prog = floor($loop->task->diffdiff);
        }
        foreach ($order0 as $key => $loop) {
            $v = new Verta($loop->task->startDate);
            $loop->task->jStart = $v->year . "/" . $v->month . "/" . $v->day;
            $v = new Verta($loop->task->deadline);
            $loop->task->jEnd = $v->year . "/" . $v->month . "/" . $v->day;

            date_default_timezone_set("UTC");
            $loop->task->pastOr = Carbon::now()->diffInSeconds($loop->task->startDate, false);

            date_default_timezone_set("Asia/Tehran");
            $loop->task->nowt = "The time is " . date("h:i:sa");
            $loop->task->rightNow = Carbon::now()->diffInMinutes($loop->task->deadline, false);
            $loop->task->diffDead = verta($loop->task->deadline)->formatDifference();
            $loop->task->passNow = abs(Carbon::now()->diffInDays($loop->task->startDate, false));
            $loop->task->passNowHours = abs(Carbon::now()->diffInMinutes($loop->task->startDate, false));
            $loop->task->diffDate = abs(Carbon::parse($loop->task->startDate)->diffInMinutes($loop->task->deadline, false)) + 1;
            $loop->task->diffdiff = (($loop->task->passNowHours) * 100) / ($loop->task->diffDate);
            $loop->task->prog = floor($loop->task->diffdiff);
        }
        foreach ($order1 as $key => $loop) {
            $v = new Verta($loop->task->startDate);
            $loop->task->jStart = $v->year . "/" . $v->month . "/" . $v->day;
            $v = new Verta($loop->task->deadline);
            $loop->task->jEnd = $v->year . "/" . $v->month . "/" . $v->day;

            date_default_timezone_set("UTC");
            $loop->task->pastOr = Carbon::now()->diffInSeconds($loop->task->startDate, false);

            date_default_timezone_set("Asia/Tehran");
            $loop->task->nowt = "The time is " . date("h:i:sa");
            $loop->task->rightNow = Carbon::now()->diffInMinutes($loop->task->deadline, false);
            $loop->task->diffDead = verta($loop->task->deadline)->formatDifference();
            $loop->task->passNow = abs(Carbon::now()->diffInDays($loop->task->startDate, false));
            $loop->task->passNowHours = abs(Carbon::now()->diffInMinutes($loop->task->startDate, false));
            $loop->task->diffDate = abs(Carbon::parse($loop->task->startDate)->diffInMinutes($loop->task->deadline, false)) + 1;
            $loop->task->diffdiff = (($loop->task->passNowHours) * 100) / ($loop->task->diffDate);
            $loop->task->prog = floor($loop->task->diffdiff);
        }
        foreach ($order3 as $key => $loop) {
            $v = new Verta($loop->task->startDate);
            $loop->task->jStart = $v->year . "/" . $v->month . "/" . $v->day;
            $v = new Verta($loop->task->deadline);
            $loop->task->jEnd = $v->year . "/" . $v->month . "/" . $v->day;

            date_default_timezone_set("UTC");
            $loop->task->pastOr = Carbon::now()->diffInSeconds($loop->task->startDate, false);

            date_default_timezone_set("Asia/Tehran");
            $loop->task->nowt = "The time is " . date("h:i:sa");
            $loop->task->rightNow = Carbon::now()->diffInMinutes($loop->task->deadline, false);
            $loop->task->diffDead = verta($loop->task->deadline)->formatDifference();
            $loop->task->passNow = abs(Carbon::now()->diffInDays($loop->task->startDate, false));
            $loop->task->passNowHours = abs(Carbon::now()->diffInMinutes($loop->task->startDate, false));
            $loop->task->diffDate = abs(Carbon::parse($loop->task->startDate)->diffInMinutes($loop->task->deadline, false)) + 1;
            $loop->task->diffdiff = (($loop->task->passNowHours) * 100) / ($loop->task->diffDate);
            $loop->task->prog = floor($loop->task->diffdiff);
        }
        foreach ($order012 as $key => $loop) {
            $v = new Verta($loop->task->startDate);
            $loop->task->jStart = $v->year . "/" . $v->month . "/" . $v->day;
            $v = new Verta($loop->task->deadline);
            $loop->task->jEnd = $v->year . "/" . $v->month . "/" . $v->day;

            date_default_timezone_set("UTC");
            $loop->task->pastOr = Carbon::now()->diffInSeconds($loop->task->startDate, false);

            date_default_timezone_set("Asia/Tehran");
            $loop->task->nowt = "The time is " . date("h:i:sa");
            $loop->task->rightNow = Carbon::now()->diffInMinutes($loop->task->deadline, false);
            $loop->task->diffDead = verta($loop->task->deadline)->formatDifference();
            $loop->task->passNow = abs(Carbon::now()->diffInDays($loop->task->startDate, false));
            $loop->task->passNowHours = abs(Carbon::now()->diffInMinutes($loop->task->startDate, false));
            $loop->task->diffDate = abs(Carbon::parse($loop->task->startDate)->diffInMinutes($loop->task->deadline, false)) + 1;
            $loop->task->diffdiff = (($loop->task->passNowHours) * 100) / ($loop->task->diffDate);
            $loop->task->prog = floor($loop->task->diffdiff);
        }
        foreach ($order as $key => $loop) {
            $v = new Verta($loop->task->startDate);
            $loop->task->jStart = $v->year . "/" . $v->month . "/" . $v->day;
            $v = new Verta($loop->task->deadline);
            $loop->task->jEnd = $v->year . "/" . $v->month . "/" . $v->day;

            date_default_timezone_set("UTC");
            $loop->task->pastOr = Carbon::now()->diffInSeconds($loop->task->startDate, false);

            date_default_timezone_set("Asia/Tehran");
            $loop->task->nowt = "The time is " . date("h:i:sa");
            $loop->task->rightNow = Carbon::now()->diffInMinutes($loop->task->deadline, false);
            $loop->task->diffDead = verta($loop->task->deadline)->formatDifference();
            $loop->task->passNow = abs(Carbon::now()->diffInDays($loop->task->startDate, false));
            $loop->task->passNowHours = abs(Carbon::now()->diffInMinutes($loop->task->startDate, false));
            $loop->task->diffDate = abs(Carbon::parse($loop->task->startDate)->diffInMinutes($loop->task->deadline, false)) + 1;
            $loop->task->diffdiff = (($loop->task->passNowHours) * 100) / ($loop->task->diffDate);
            $loop->task->prog = floor($loop->task->diffdiff);
        }



        $statuses = Status::with('user')->orderBy('created_at','DESC')->get();
        $dateBefore = Carbon::now();
        foreach ($statuses as $key => $loop){
            $loop->jCreated_at = new Verta($loop->created_at);
            $loop->diff = verta($loop->created_at)->formatDifference();
            $loop->diffM = abs(Carbon::parse($loop->created_at)->diffInMinutes($dateBefore, false));
        }

        $lastStartedStatus = Status::with('user')->where('user_id',$user->id)->where('status','start')->orWhere('status','end')->orderBy('created_at','desc')->first();
        $userLastStatus = TaskOrderUser::where('user_id',$user->id)->orderBy('updated_at','desc')->first();

        $titleOfPage = 'کارهای من';
        $urlP = url()->current();

        return view('tasks.index', compact('order012','order0','order3','order1','orderRoutine','urlP','order','userLastStatus','lastStartedStatus','user','usersInTasks','users','usersStatus','titleOfPage','myTasksStatus','statuses','statusesToMe'));
    }
    public function create()
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
        $lastStartedStatus = Status::with('user')->where('user_id',$user->id)->where('status','start')->orWhere('status','end')->orderBy('created_at','desc')->first();




        $categories = Category::where('parent_id', '=' , '0')->get();
        $materials = Category::where('isMaterial', '=' , '1')->get();
        $dimensions = Category::where('isDimension', '=' , '1')->get();
        $types = Category::where('isType', '=' , '1')->orderby('title','asc')->get();
        $childCategories = Category::where('parent_id', '!=' , '0')->get();
        $users = User::all();
        $brands = Brand::all();
        $user_id = Auth::user()->id;
        $nowDate = new Verta();
        $jNow = $nowDate->year . "/" . $nowDate->month . "/" . $nowDate->day;
        $urlP = url()->previous();
        $titleOfPage = 'کار جدید';

        return view('tasks.create', compact('lastStartedStatus','categories','statusesToMe','myTasksStatus','usersStatus','users', 'childCategories','brands','materials','user_id','dimensions','types','jNow','urlP', 'titleOfPage','user'));

    }
    public function store(Request $request)
    {

        $input=$request->all();
        $images=array();



        $request->validate([
            'pic' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title'=>'required',
            'startTime'=>'required',
            'endTime'=>'required',
            'content'=> 'required'
        ]);

        $t = $request->input('isType2');
        if(isset($t) && $t != ""){
            $t = $request->input('isType2');
        }else{
            $t = $request->input('isType');

        }
        $taskTitle = "";
        if($request->get('title') == "ندارد" || empty($request->get('title'))){
            $taskTitle = $request->get('subject') ." ". $t ." ". $request->get('forProduct') ." ". $request->get('brand');

        }else{
            $taskTitle = $request->get('title');
        }

        $date = new DateTime($request->get('endDate'));
        $time = new DateTime($request->get('endTime'));
        $mergeEnd = new DateTime($date->format('Y-m-d') .' ' .$time->format('H:i:s'));
        $date = new DateTime($request->get('startDate'));
        $time = new DateTime($request->get('startTime'));
        $mergeStart = new DateTime($date->format('Y-m-d') .' ' .$time->format('H:i:s'));

        $t = $request->input('isType2');
        if(isset($t) && $t != ""){
            $t = $request->input('isType2');
        }else{
            $t = $request->input('isType');

        }

        $task = new Task([

            'title' => $taskTitle,
            'content'=> $request->get('content'),
            'deadline'=> $mergeEnd->format('Y-m-d H:i:s'),//$request->get('endDate'),
            'startDate'=> $mergeStart->format('Y-m-d H:i:s'),//$request->get('startDate'),
            'reTask'=> $request->get('reTask'),
            'orderTask'=> $request->get('orderTask'),
            'weight'=> $request->get('weight'),
            'brand'=> $request->get('brand'),
            'material'=> $request->get('material'),
            'dx'=> $request->get('dx'),
            'dy'=> $request->get('dy'),
            'dz'=> $request->get('dz'),
            'dDesc'=> $request->get('dDesc'),
            'pending'=> $request->get('pending'),
            'type'=> $t,
            'forProduct'=> $request->get('forProduct'),
            'subject'=> $request->get('subject'),
            'user_id'=> Auth::user()->id
        ]);

        if(!empty($request->pic)) {
            $picName = $task->id . '_task' . time() . '.' . request()->pic->getClientOriginalExtension();
            $request->pic->storeAs('uploads', $picName);
            $task->pic = $picName;
        }
        $task->save();
        $task->categories()->attach($request->categories);
        $task->categories()->attach($request->categorieschild);
        if($request->get('pending') != 2){
            $task->users()->attach($request->users);

        }
        $task->userOrder()->attach($request->users);
        $status = new Status([
            'status'    => 'new-task',
            'content'   => 'ثبت کار جدید',
            'task_id'   => $task->id,
            'user_id'   => Auth::id(),
        ]);
        $status->save();



//        if($files=$request->file('medias')){
//            foreach($files as $file){
//                $name=$file->getClientOriginalName();
//                $file->move('imagex',$name);
//                $images[]=$name;
//            }
//        }
//        /*Insert your data*/

//        Media::insert( [
//            'name'=>  implode("|",$images),
//            'user_id' => Auth::user()->id,
//            'task_id' => $task->id,
//            //you can put other insertion here
//        ]);






//        $users = $request->input('users');
//        $users = implode(',', $users);
//        $input['users'] = $users;
//        $task->users()->attach($input);
//
//        $categories = $request->input('categories');
//        $categories = implode(',', $categories);
//        //$input = $request->except('categories');
//        $input['categories'] = $categories;
//        $task->categories()->attach($input);
        //$task->categories()->attach($request->categories, false);
        //        $user->roles()->attach([
        //            1 => ['expires' => $expires],
        //            2 => ['expires' => $expires]
        //        ]);
        $urlP = $request->get('urlP');

        return redirect($urlP)->with('success');
    }
    public function show($id)
    {
        $user = Auth::user();
        $myTasksStatus = $user->taskOrder()->get();
        $usersStatus = User::all();
        $statusesToMe = Status::with('user')->where('to_user',$user->id)->orderBy('created_at','DESC')->get();
        $dateBefore = Carbon::now();

        foreach ($statusesToMe as $key => $loop){
            $loop->jCreated_at = new Verta($loop->created_at);
            $loop->diff = verta($loop->created_at)->formatDifference();
            $loop->diffM = abs(Carbon::parse($loop->created_at)->diffInMinutes($dateBefore, false));


        }
        $lastStartedStatus = Status::with('user')->where('user_id',$user->id)->where('status','start')->orWhere('status','end')->orderBy('created_at','desc')->first();


        $user = Auth::user();
        $task = Task::findOrFail($id);
        $dateBefore = Carbon::now();



        $dead = Carbon::now()->diffInDays($task->deadline, false);
        $task->increment('viewCount');
        $task->jStartDate = new Verta($task->startDate);
        $task->jDeadline = new Verta($task->deadline);



        $admin = User::findOrFail($task->user_id);
        $users = $task->users()->where('task_id',$id)->get()->pluck('id')->toArray();
        $urlP = url()->previous();
        $titleOfPage = $task->title;



        $statuses = Status::with('user')->orderBy('created_at','DESC')->get();
        $dateBefore = Carbon::now();

        foreach ($statuses as $key => $loop){
            $loop->jCreated_at = new Verta($loop->created_at);
            $loop->diff = verta($loop->created_at)->formatDifference();
            $loop->diffM = abs(Carbon::parse($loop->created_at)->diffInMinutes($dateBefore, false));


        }

        if(in_array($user->id, $users)){
            $users = $task->users()->where('task_id',$id)->get();
            return view('tasks.show', compact('task','lastStartedStatus','statusesToMe','statuses', 'dead','user','users','usersStatus','admin','urlP','titleOfPage','myTasksStatus'));
        }elseif ($user->id == 1 || $user->id == 2 || $user->id == 14 || $task->id == 28){
            $users = $task->users()->where('task_id',$id)->get();
            return view('tasks.show', compact('task','lastStartedStatus','statusesToMe','statuses', 'dead','user','users','usersStatus','admin','urlP','titleOfPage','myTasksStatus'));
        }else{
            return redirect()->back();
        }



    }
    public function edit($id)
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
        $lastStartedStatus = Status::with('user')->where('user_id',$user->id)->where('status','start')->orWhere('status','end')->orderBy('created_at','desc')->first();


        $task = Task::where('id',$id)->with('user')->whereHas('user')->first();
        $brands = Brand::all();
        $users_old = $task->users()->where('task_id',$id)->get();
        $users = User::all();
        $nowDate = new Verta($task->startDate);
        $jStart = $nowDate->year . "/" . $nowDate->month . "/" . $nowDate->day;
        $nowDate = new Verta($task->deadline);
        $jEnd = $nowDate->year . "/" . $nowDate->month . "/" . $nowDate->day;
        $urlP = url()->previous();
        $titleOfPage = 'ویرایش ' . $task->title;


        return view('tasks.edit', compact('task','lastStartedStatus','statusesToMe','myTasksStatus','usersStatus', 'brands','users','users_old','jEnd','jStart','urlP','titleOfPage'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'title'=>'required',
            'content'=> 'required'
        ]);

        $date = new DateTime($request->get('endDate'));
        $time = new DateTime($request->get('endTime'));
        $mergeEnd = new DateTime($date->format('Y-m-d') .' ' .$time->format('H:i:s'));
        $date = new DateTime($request->get('startDate'));
        $time = new DateTime($request->get('startTime'));
        $mergeStart = new DateTime($date->format('Y-m-d') .' ' .$time->format('H:i:s'));

        $task = Task::find($id);
        $task->deadline = $mergeEnd;
        $task->startDate = $mergeStart;
        $task->reTask = $request->get('reTask');
        $task->orderTask = $request->get('orderTask');
        $task->weight = $request->get('weight');
        $task->brand = $request->get('brand');
        $task->material = $request->get('material');
        $task->dx = $request->get('dx');
        $task->dy = $request->get('dy');
        $task->dz = $request->get('dz');
        $task->dDesc = $request->get('dDesc');
        $task->pending = $request->get('pending');
        $task->type = $request->get('isType');
        $task->forProduct = $request->get('forProduct');
        $task->title = $request->get('title');
        $task->content = $request->get('content');
        $task->subject = $request->get('subject');
        if(!empty($request->pic)) {
            $picName = $task->id . '_task' . time() . '.' . request()->pic->getClientOriginalExtension();
            $request->pic->storeAs('uploads', $picName);
            $task->pic = $picName;
        }
        $pic2 = $request->get('pic2');
        if($pic2 == 'dsp.png')
        {
            $task->pic = 'dsp.png';
        }
        $task->save();

        $isUser = $request->input('isUser');
        if (isset($isUser) && $isUser == 1){

        }else{

                $task->users()->sync($request->get('users'));
                $task->userOrder()->sync($request->get('users'));

        }

        $urlP = $request->get('urlP');





        return redirect($urlP)->with('success');
    }
    public function pending()
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
        $lastStartedStatus = Status::with('user')->where('user_id',$user->id)->where('status','start')->orWhere('status','end')->orderBy('created_at','desc')->first();


        $user = Auth::user();
        $users = User::all();

        if(isset($_GET['nouser'])){
            $tasks = Task::where('pending', '2')->orderBy('updated_at','DESC')->paginate(20);
        }else{
            $tasks = Task::where('pending', '1')->orderBy('updated_at','DESC')->paginate(20);
        }

        $usersInTasks = TaskUser::all();
        $i = 1; $skipped = ($tasks->currentPage() - 1) * $tasks->perPage();
        foreach ($tasks as $key => $loop) {
            $v = new Verta($loop->startDate);
            $loop->jStart = $v->year . "/" . $v->month . "/" . $v->day;
            $v = new Verta($loop->deadline);
            $loop->jEnd = $v->year . "/" . $v->month . "/" . $v->day;
            $loop->i = $skipped + $i++;
        }
        foreach ($tasks as $key => $loop)
        {
            date_default_timezone_set("UTC");

            $loop->pastOr = Carbon::now()->diffInSeconds($loop->startDate, false);

            date_default_timezone_set("Asia/Tehran");

            $loop->nowt = "The time is " . date("h:i:sa");
            $loop->rightNow = Carbon::now()->diffInMinutes($loop->deadline, false);
            $loop->diffDead = verta($loop->deadline)->formatDifference();
            $loop->passNow = abs(Carbon::now()->diffInDays($loop->startDate, false));

            $loop->passNowHours = abs(Carbon::now()->diffInMinutes($loop->startDate, false));
            $loop->diffDate = abs(Carbon::parse($loop->startDate)->diffInMinutes($loop->deadline, false)) + 1;
            $diffdiff = (($loop->passNowHours) * 100) / ($loop->diffDate);
            $loop->prog = floor($diffdiff);




        }
$linked = 'pending';
        $titleOfPage = 'کارهای در انتظار';
        $jobPage = 'new';

        $statuses = Status::with('user')->orderBy('created_at','DESC')->get();
        $dateBefore = Carbon::now();


        foreach ($statuses as $key => $loop){
            $loop->jCreated_at = new Verta($loop->created_at);
            $loop->diff = verta($loop->created_at)->formatDifference();
            $loop->diffM = abs(Carbon::parse($loop->created_at)->diffInMinutes($dateBefore, false));


        }
        $urlP = '/';

        return view('tasks.pending', compact('urlP','lastStartedStatus','tasks','statusesToMe','statuses','myTasksStatus','usersStatus','users','user','usersInTasks','linked','titleOfPage','jobPage'));








    }
    public function pendingUser($id)
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
        $lastStartedStatus = Status::with('user')->where('user_id',$user->id)->where('status','start')->orWhere('status','end')->orderBy('created_at','desc')->first();

        $user = User::find($id);
        $users = User::all();


        $tasks = $user->tasks()->where('pending', '1')->orderBy('updated_at','DESC')->paginate(20);
        $usersInTasks = TaskUser::all();
        $i = 1; $skipped = ($tasks->currentPage() - 1) * $tasks->perPage();
        foreach ($tasks as $key => $loop) {
            $v = new Verta($loop->startDate);
            $loop->jStart = $v->year . "/" . $v->month . "/" . $v->day;
            $v = new Verta($loop->deadline);
            $loop->jEnd = $v->year . "/" . $v->month . "/" . $v->day;
            $loop->i = $skipped + $i++;
        }
        foreach ($tasks as $key => $loop)
        {
            date_default_timezone_set("UTC");

            $loop->pastOr = Carbon::now()->diffInSeconds($loop->startDate, false);

            date_default_timezone_set("Asia/Tehran");
            $loop->nowt = "The time is " . date("h:i:sa");
            $loop->rightNow = Carbon::now()->diffInMinutes($loop->deadline, false);
            $loop->diffDead = verta($loop->deadline)->formatDifference();
            $loop->passNow = abs(Carbon::now()->diffInDays($loop->startDate, false));

            $loop->passNowHours = abs(Carbon::now()->diffInMinutes($loop->startDate, false));
            $loop->diffDate = abs(Carbon::parse($loop->startDate)->diffInMinutes($loop->deadline, false)) + 1;
            $diffdiff = (($loop->passNowHours) * 100) / ($loop->diffDate);
            $loop->prog = floor($diffdiff);




        }
$linked = 'pending';
$titleOfPage = 'کارهای در انتظار'. " " .$user->name;

        $statuses = Status::with('user')->orderBy('created_at','DESC')->get();
        $dateBefore = Carbon::now();

        foreach ($statuses as $key => $loop){
            $loop->jCreated_at = new Verta($loop->created_at);
            $loop->diff = verta($loop->created_at)->formatDifference();
            $loop->diffM = abs(Carbon::parse($loop->created_at)->diffInMinutes($dateBefore, false));


        }

        return view('tasks.pending', compact('lastStartedStatus','tasks','statusesToMe','myTasksStatus','usersStatus','users','user','usersInTasks','linked','titleOfPage','statuses'));


    }
    public function modir()
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
        $lastStartedStatus = Status::with('user')->where('user_id',$user->id)->where('status','start')->orWhere('status','end')->orderBy('created_at','desc')->first();

        $user = Auth::user();
        $users = User::with('usersOn')->get();
//        dd($users);

        $linked = 'jobs';
        $titleOfPage = 'مشاهده کارها';

        $statuses = Status::with('user')->orderBy('created_at','DESC')->get();
        $dateBefore = Carbon::now();

        foreach ($statuses as $key => $loop){
            $loop->jCreated_at = new Verta($loop->created_at);
            $loop->diff = verta($loop->created_at)->formatDifference();
            $loop->diffM = abs(Carbon::parse($loop->created_at)->diffInMinutes($dateBefore, false));
        }
        $userLastStatus = $user->lastStatusUser()->orderBy('updated_at','desc')->first();


        return view('tasks.modir', compact('lastStartedStatus','statusesToMe','statuses','myTasksStatus','usersStatus','users','user','linked','titleOfPage'));
    }
    public function modirUser($id)
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
        $lastStatus = Status::with('user')->where('user_id',$id)->orderBy('created_at','desc')->first();


        $usersInTasks = TaskOrderUser::all();
        $user = User::find($id);
        $ids=[2,1,3,4,6,7,9,10,22,28,30];
        $users = User::whereIn('id',$ids)->orderBy('sort','asc')->get();
       // $tasks = $user->taskOrder()->where('isDone', '0')->where('pending','0')->orderBy('updated_at','DESC')->paginate(200);
        $order = TaskOrderUser::with('task')->whereHas('task')->where('user_id',$id)->where('isDone',0)->whereIn('lastStatus',[0,1,2,4,5])->orderBy('order_column','asc')->get();
        foreach ($users as $key => $loop) {
            $loop->count = TaskOrderUser::with('task')->whereHas('task')->where('user_id',$loop->id)->where('isDone',0)->whereIn('lastStatus',[0,1,2,4,5])->orderBy('order_column','asc')->count();

        }

            //        $orderTasks =
//        $orderUsers = TaskOrderUser::where('user_id',$id)->orderBy('order_column','asc')->get();
//        $order = TaskOrderUser::where('user_id',$id)->get();
//        foreach($order as $k => $v) {
//            $a[] = $v['task_id'];
//            $u = $v['user_id'];
//        }
//                $tasks = Task::whereIn('id',$a)->where('isDone', '0')->paginate(200);
//                $users = User::whereIn('id',$u)->get();

//        $tasks = Task::all();
//        $tasks = $user->taskOrder()->with('statusInLine')->paginate(100);
//        $tasks = Task::where('isDone', '0')->where('pending','0')->get();

//        $jobPage = 'new';
//        if(isset($_GET['pageType']) && $_GET['pageType'] == 'old'){
//            $jobPage = 'old';
//             $tasks = $user->taskOrder()->orderBy('pending','desc')->paginate(200);
////             $tasks = $user->taskOrder()->where('isDone', '0')->orderBy('pending','ASC')->orderBy('orderTask','ASC')->orderBy('updated_at','DESC')->orderBy('deadline','ASC')->paginate(200);
//
//        }
//        $tasks = Task::whereIn('id',$a)->where('isDone', '0')->where('pending','0')->orderBy('updated_at','DESC')->paginate(200);

//        dd($tasks);
       // $tasks = $user->tasks()->where('isDone', '0')->orderBy('pending','ASC')->orderBy('orderTask','ASC')->orderBy('updated_at','DESC')->orderBy('deadline','ASC')->paginate(20);
//        $i = 1; $skipped = ($tasks->currentPage() - 1) * $tasks->perPage();
//        foreach ($tasks as $key => $loop) {
//            $v = new Verta($loop->startDate);
//            $loop->jStart = $v->year . "/" . $v->month . "/" . $v->day;
//            $v = new Verta($loop->deadline);
//            $loop->jEnd = $v->year . "/" . $v->month . "/" . $v->day;
////            $loop->i = $skipped + $i++;
//        }
//        foreach ($tasks as $key => $loop)
//        {
//            date_default_timezone_set("UTC");
//
//            $loop->pastOr = Carbon::now()->diffInSeconds($loop->startDate, false);
//
//            date_default_timezone_set("Asia/Tehran");
//            $loop->nowt = "The time is " . date("h:i:sa");
//            $loop->rightNow = Carbon::now()->diffInMinutes($loop->deadline, false);
//            $loop->diffDead = verta($loop->deadline)->formatDifference();
//            $loop->passNow = abs(Carbon::now()->diffInDays($loop->startDate, false));
//
//            $loop->passNowHours = abs(Carbon::now()->diffInMinutes($loop->startDate, false));
//            $loop->diffDate = abs(Carbon::parse($loop->startDate)->diffInMinutes($loop->deadline, false)) + 1;
//            $diffdiff = (($loop->passNowHours) * 100) / ($loop->diffDate);
//            $loop->prog = floor($diffdiff);
//
//
//
//
//
//
//        }
        $title = $user->name;

        $titleOfPage = 'کارهای'. ' ' . $user->name;
        $linked = 'jobs';


        $statuses = Status::with('user')->orderBy('created_at','DESC')->get();
        $dateBefore = Carbon::now();

        foreach ($statuses as $key => $loop){
            $loop->jCreated_at = new Verta($loop->created_at);
            $loop->diff = verta($loop->created_at)->formatDifference();
            $loop->diffM = abs(Carbon::parse($loop->created_at)->diffInMinutes($dateBefore, false));
        }
        $lastStartedStatus = Status::with('user')->where('user_id',$id)->where('status','start')->orWhere('status','end')->orderBy('created_at','desc')->first();
        $userLastStatus = $user->lastStatusUser()->orderBy('updated_at','desc')->first();
     return view('tasks.modir', compact('lastStatus','userLastStatus','lastStartedStatus','statusesToMe','statuses','myTasksStatus','usersStatus','users','user','title','usersInTasks','linked','titleOfPage','linked','order'));
    }
    public function modirTaskAll()
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
        $lastStatus = Status::with('user')->where('user_id',Auth::id())->orderBy('created_at','desc')->first();

        $usersInTasks = TaskOrderUser::all();
        $user = User::find(Auth::id());
        $ids=[2,1,3,4,6,7,9,10,22,28,30];
        $users = User::whereIn('id',$ids)->orderBy('sort','asc')->get();
       // $tasks = $user->taskOrder()->where('isDone', '0')->where('pending','0')->orderBy('updated_at','DESC')->paginate(200);
        $order = TaskOrderUser::with('task')->whereHas('task')->where('user_id',Auth::id())->where('isDone',0)->whereIn('lastStatus',[0,1,2,4,5])->orderBy('order_column','asc')->get();
        foreach ($users as $key => $loop) {
            $loop->count = TaskOrderUser::with('task')->whereHas('task')->where('user_id',$loop->id)->where('isDone',0)->whereIn('lastStatus',[0,1,2,4,5])->orderBy('order_column','asc')->count();

        }

        $title = $user->name;

        $titleOfPage = 'کارهای'. ' ' . $user->name;
        $linked = 'jobs';


        $statuses = Status::with('user')->orderBy('created_at','DESC')->get();
        $dateBefore = Carbon::now();

        foreach ($statuses as $key => $loop){
            $loop->jCreated_at = new Verta($loop->created_at);
            $loop->diff = verta($loop->created_at)->formatDifference();
            $loop->diffM = abs(Carbon::parse($loop->created_at)->diffInMinutes($dateBefore, false));
        }
        $lastStartedStatus = Status::with('user')->where('user_id',Auth::id())->where('status','start')->orWhere('status','end')->orderBy('created_at','desc')->first();
        $userLastStatus = $user->lastStatusUser()->orderBy('updated_at','desc')->first();
     return view('tasks.modirAll', compact('lastStatus','userLastStatus','lastStartedStatus','statusesToMe','statuses','myTasksStatus','usersStatus','users','user','title','usersInTasks','linked','titleOfPage','linked','order'));
    }
    public function modirUserPrint($id)
    {
        $today = Verta::now(); //1396-03-02 00:00:00
        $user = User::find($id);

        $order = TaskOrderUser::
        with('task')->
        whereHas('task')->
        where('user_id',$id)->
        where('isDone',0)->
        whereIn('lastStatus',[0,1,2,5,6])->
        orderBy('routine','asc')->
        orderBy('order_column','asc')->
        get();

        $title = $user->name;
        foreach ($order as $key => $loop){
            $loop->diff = verta($loop->updated_at)->formatDifference();
            $loop->users = TaskOrderUser::where('task_id',$loop->task_id)->with('user')->get();
        }
//        dd($order);
     return view('tasks.modirPrint', compact('today','user','title','order'));
    }
    public function destroy(Request $request,$id)
    {
        $task = Task::find($id);
        $task->delete();
        $urlP = $request->get('urlP');


        return redirect($urlP)->with('success');
    }
    public function finance(){



        if (isset($_GET['s'])){
            $s = $_GET['s'];
            $stype = $_GET['type'];
            $sbrand = $_GET['brand'];
            $sforProduct = $_GET['forProduct'];
            $searchValues = preg_split('/\s+/', $s, -1, PREG_SPLIT_NO_EMPTY);
            $tasks = Task::
            where('type', 'like', $stype)->
            where('brand', 'like', $sbrand)->
            where('forProduct', 'like', $sforProduct)
                ->where(function ($q) use ($searchValues) {
                    foreach ($searchValues as $value) {
                        $q->where('title', 'like', "%{$value}%")
                            ->where('payOK', 1);
                    }
                })->get();}else if (isset($_GET['status'])){
            $status = $_GET['status'];
            $sort = $_GET['sort'];
            $order = $_GET['order'];
            if ($status == 'all'){
                $tasks = Task::orderBy($sort,$order)->get();
            }elseif ($status == 'done'){
                $taskDone1 = TaskOrderUser::where('isDone',1)->pluck('task_id')->toArray();
                $taskDone0 = TaskOrderUser::where('isDone',0)->pluck('task_id')->toArray();
                $collection = collect($taskDone1);
                $diff = $collection->diff($taskDone0);
                $diff->all();
                $tasks = Task::whereIn('id',$diff)->orderBy($sort,$order)->get();
            }
        }else{
            $tasks = Task::orderBy('updated_at','desc')->where('cost' , '>' , 0)->get();

        }
        $total = Task::where('paid',1)->pluck('cost')->toArray();
        $sum = 0;
        foreach ($total as $t){
            $sum += $t;
        }
        $taskSearch = Task::orderBy('updated_at','desc')->get();

        $types = $taskSearch->pluck('type')->sort()->toArray();
        foreach ($types as $c) {$type[$c] = $c;}
        $brands = $taskSearch->pluck('brand')->sort()->toArray();
        foreach ($brands as $c) {$brand[$c] = $c;}
        $forProducts = $taskSearch->pluck('forProduct')->sort()->toArray();
        foreach ($forProducts as $c) {$forProduct[$c] = $c;}

        return view('tasks.finance', compact('tasks','sum','type','brand','forProduct'));
    }
    public function finance1(){
        $taskDone1 = TaskOrderUser::where('isDone',1)->pluck('task_id')->toArray();
        $taskDone0 = TaskOrderUser::where('isDone',0)->pluck('task_id')->toArray();
        $collection = collect($taskDone1);
        $diff = $collection->diff($taskDone0);
        $diff->all();

            $tasks = Task::whereIn('id',$diff)->where('cost' , '>' , 0)->where('payOK' , 0)->orderBy('updated_at','desc')->get();



        $total = Task::where('paid',1)->pluck('cost')->toArray();
        $sum = 0;
        foreach ($total as $t){
            $sum += $t;
        }


        return view('tasks.finance', compact('tasks','sum'));
    }
    public function finance2(){
        if (isset($_GET['s'])){
            $s = $_GET['s'];
            $stype = $_GET['type'];
            $sbrand = $_GET['brand'];
            $sforProduct = $_GET['forProduct'];
            $searchValues = preg_split('/\s+/', $s, -1, PREG_SPLIT_NO_EMPTY);
            $tasks = Task::
                where('type', 'like', $stype)->
                where('brand', 'like', $sbrand)->
                where('forProduct', 'like', $sforProduct)
                ->where(function ($q) use ($searchValues) {
                foreach ($searchValues as $value) {
                    $q->where('title', 'like', "%{$value}%")
                        ->where('payOK', 1);
                }
            })->get();}else{
            $tasks = Task::orderBy('updated_at','desc')->where('payOK', 1)->get();
        }

        $taskSearch = Task::orderBy('updated_at','desc')->where('payOK', 1)->get();

        $types = $taskSearch->pluck('type')->sort()->toArray();
        foreach ($types as $c) {$type[$c] = $c;}
        $brands = $taskSearch->pluck('brand')->sort()->toArray();
        foreach ($brands as $c) {$brand[$c] = $c;}
        $forProducts = $taskSearch->pluck('forProduct')->sort()->toArray();
        foreach ($forProducts as $c) {$forProduct[$c] = $c;}

        return view('tasks.finance', compact('tasks','type','brand','forProduct'));
    }
    public function financeUpdate($id,Request $request)
    {
//        $cost = $request->get('cost');
//        $pay = $request->get('payOK');

        $item = Task::find($id);
//        $item->cost = $cost;
//        if (!empty($pay)){
//            $item->payOK = $request->get('payOK');
//        }
//        $item->save();
        $item->update($request->all());
        if (isset($request->payOK)){
            $statusTitle = 'pay-ok';
            $content = 'تایید وضعیت مالی';
        }else{
            $statusTitle = 'cost-update';
            $content = 'تغییر یا ثبت قیمت';

        }
        $status = new Status([
            'status'    => $statusTitle,
            'content'   => $content,
            'task_id'   => $id,
            'user_id'   => Auth::id(),
        ]);
        $status->save();

        return back();
    }
    public function taskPayForm(){
        $id = $_GET['ID'];
        $task = Task::find($id);
        if ($task->paid === 0){
            $task->paid = 1;
            $statusTitle = 'paid';
            $content = 'تایید پرداخت';
        }elseif ($task->paid ===1){
            $task->paid = 0;
            $statusTitle = 'un-paid';
            $content = 'عدم تایید پرداخت';


        }
        $task->save();


        $status = new Status([
            'status'    => $statusTitle,
            'content'   => $content,
            'task_id'   => $task->id,
            'user_id'   => Auth::id(),
        ]);
        $status->save();


        return redirect()->back()->with('message', 'تغییرات '.$task->id.' با موفقیت ثبت شد');

    }

//    ADMIN SECTION

    public function request(){
        $brands = Brand::all();

        return view('tasks.request',compact('brands'));
    }
    public function requestPost(Request $request){
        $brands = Brand::all();
        $success = 'success';
        $user = Auth::user();


        $task = new Task([
            'title' => $request->get('title'),
            'content'=> $request->get('content'),
            'brand_id'=> $request->get('brand'),
            'pending'=> 2,
            'user_id'=> Auth::user()->id

        ]);
        $task->save();

            $task->jCreated_at = verta($task->created_at)->formatWord('l dS F');

        return view('tasks.request',compact('success','brands','task'));
    }
    public function searchTasks(){
//        $s = $_GET['s'];
//        $tasks = Task::where('title', 'like', '%' . $s . '%')->get();
//        return $tasks;
        return Task::all();
    }
    public function taskAdmin(){
        $taskCount = Task::all()->count();
//        if (isset($_GET['s'])&&$_GET['s']!=null){
//            $statuses = Status::where('status',$_GET['s'])->orderBy('updated_at','desc')->with('user','task')->paginate(20);
//        }else{
//        $statuses = Status::whereIn('status',['end','start','print','follow','pending'])->orderBy('updated_at','desc')->with('user','task')->whereHas('task')->get();
//        }
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
//                $loop->jd = verta($loop->updated_at)->formatJalaliDatetime();
//                $loop->diff = verta($loop->updated_at)->formatDifference();
//
//        }
        $dateNow = verta()->formatJalaliDatetime();

        $tasks = Task::all();

            return view('tasks.taskAdmin',compact('tasks','taskCount','dateNow'));
    }


}
