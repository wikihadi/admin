<?phpnamespace App\Http\Controllers;use App\Category;use App\Media;use App\TaskMeter;use App\User;use App\Comment;use App\Task;use App\Brand;//use http\Client\Curl\User as User;use DateTime;use Verta;use Illuminate\Http\Request;use Illuminate\Support\Carbon;use Illuminate\Support\Facades\Auth;class TaskController extends Controller{    public function __construct()    {        $this->middleware('auth');        $this->middleware('permission:task-list');        $this->middleware('permission:task-create', ['only' => ['create','store']]);        $this->middleware('permission:task-edit', ['only' => ['edit','update']]);        $this->middleware('permission:task-delete', ['only' => ['destroy']]);    }    /**     * Display a listing of the resource.     *     * @return \Illuminate\Http\Response     */    public function index()    {        $user = Auth::user();        $taskMeter = TaskMeter::where('user_id', $user->id)->orderBy('created_at','DESC')->first();        $tasks = $user->tasks()->where('isDone', '0')->orderBy('orderTask','ASC')->orderBy('deadline','ASC')->paginate(10);//        $tasks = Task::orderBy('deadline','ASC')->paginate(9);//        $team = User::with('tasks');//        foreach ($tasks as $key => $loop)        {            date_default_timezone_set("Asia/Tehran");//            $now = new Carbon();//            $dt = new Carbon($this->created_at);//            $dt->setLocale('es');//            return $dt->diffForHumans($now);            $loop->nowt = "The time is " . date("h:i:sa");            $loop->rightNow = Carbon::now()->diffInMinutes($loop->deadline, false);//            $diffDead = Carbon::now()->diffForHumans($loop->deadline, false);            $loop->diffDead = verta($loop->deadline)->formatDifference();            $loop->passNow = abs(Carbon::now()->diffInDays($loop->startDate, false));            $loop->passNowHours = abs(Carbon::now()->diffInMinutes($loop->startDate, false));            $loop->diffDate = abs(Carbon::parse($loop->startDate)->diffInMinutes($loop->deadline, false)) + 1;            $diffdiff = (($loop->passNowHours) * 100) / ($loop->diffDate);            $loop->prog = floor($diffdiff);            $v = new Verta($loop->startDate);            $loop->jStart = $v->year . "/" . $v->month . "/" . $v->day;            $v = new Verta($loop->deadline);            $loop->jEnd = $v->year . "/" . $v->month . "/" . $v->day;        }        return view('tasks.index', compact('tasks','user','taskMeter'));    }    public function allTasks()    {        $user = Auth::user();        $tasks = Task::where('isDone', '0')->orderBy('orderTask','ASC')->orderBy('deadline','ASC')->paginate(10);        foreach ($tasks as $key => $loop)        {            date_default_timezone_set("Asia/Tehran");            $loop->rightNow = Carbon::now()->diffInDays($loop->deadline, false);            $loop->passNow = abs(Carbon::now()->diffInDays($loop->startDate, false));            $loop->passNowHours = abs(Carbon::now()->diffInMinutes($loop->startDate, false));            $loop->diffDate = abs(Carbon::parse($loop->startDate)->diffInMinutes($loop->deadline, false)) + 1;            $diffdiff = (($loop->passNowHours) * 100) / ($loop->diffDate);            $loop->prog = floor($diffdiff);            $v = new Verta($loop->startDate);            $loop->jStart = $v->year . "/" . $v->month . "/" . $v->day;            $v = new Verta($loop->deadline);            $loop->jEnd = $v->year . "/" . $v->month . "/" . $v->day;        }        return view('tasks.index', compact('tasks','user'));    }    public function taskMeters()    {        $taskMeters = TaskMeter::orderBy('created_at','DESC')->get();        $users = User::all();        $tasks = Task::all();       return view('tasks.taskMeters', compact('taskMeters','users','tasks'));    }    public function isDone()    {        $user = Auth::user();        $tasks = $user->tasks()->where('isDone', '1')->orderBy('orderTask','ASC')->orderBy('deadline','ASC')->paginate(10);//        $tasks = Task::orderBy('deadline','ASC')->paginate(9);//        $team = User::with('tasks');//        foreach ($tasks as $key => $loop)        {            $loop->rightNow = Carbon::now()->diffInDays($loop->deadline, false);            $loop->passNow = abs(Carbon::now()->diffInDays($loop->startDate, false));            $loop->passNowHours = abs(Carbon::now()->diffInHours($loop->startDate, false));            $loop->diffDate = abs(Carbon::parse($loop->startDate)->diffInHours($loop->deadline, false));            $diffdiff = (($loop->passNowHours) * 100) / ($loop->diffDate);            $loop->prog = floor($diffdiff);        }        return view('tasks.index', compact('tasks','user'));    }    public function userIsDone($id)    {        $user = User::find($id);        $tasks = $user->tasks()->where('isDone', '1')->orderBy('orderTask','ASC')->orderBy('deadline','ASC')->paginate(10);//        $tasks = Task::orderBy('deadline','ASC')->paginate(9);//        $team = User::with('tasks');//        foreach ($tasks as $key => $loop)        {            $loop->rightNow = Carbon::now()->diffInDays($loop->deadline, false);            $loop->passNow = abs(Carbon::now()->diffInDays($loop->startDate, false));            $loop->passNowHours = abs(Carbon::now()->diffInHours($loop->startDate, false));            $loop->diffDate = abs(Carbon::parse($loop->startDate)->diffInHours($loop->deadline, false));            $diffdiff = (($loop->passNowHours) * 100) / ($loop->diffDate);            $loop->prog = floor($diffdiff);        }        return view('tasks.index', compact('tasks','user'));    }    /**     * Show the form for creating a new resource.     *     * @return \Illuminate\Http\Response     */    public function create()    {        $categories = Category::where('parent_id', '=' , '0')->get();        $materials = Category::where('isMaterial', '=' , '1')->get();        $dimensions = Category::where('isDimension', '=' , '1')->get();        $types = Category::where('isType', '=' , '1')->orderby('title','asc')->get();        $childCategories = Category::where('parent_id', '!=' , '0')->get();        $users = User::all();        $brands = Brand::all();        $user_id = Auth::user()->id;        $nowDate = new Verta();        $jNow = $nowDate->year . "/" . $nowDate->month . "/" . $nowDate->day;        return view('tasks.create', compact('categories','users', 'childCategories','brands','materials','user_id','dimensions','types','jNow'));    }    /**     * Store a newly created resource in storage.     *     * @param  \Illuminate\Http\Request  $request     * @return \Illuminate\Http\Response     */    public function store(Request $request)    {        $input=$request->all();        $images=array();        $request->validate([            'pic' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',            'title'=>'required',            'startTime'=>'required',            'endTime'=>'required',            'content'=> 'required'        ]);        $taskTitle = "";        if($request->get('title') == "ندارد"){            $taskTitle = $request->get('isType') ." ". $request->get('forProduct') ." ". $request->get('brand');        }else{            $taskTitle = $request->get('title');        }        $date = new DateTime($request->get('endDate'));        $time = new DateTime($request->get('endTime'));        $mergeEnd = new DateTime($date->format('Y-m-d') .' ' .$time->format('H:i:s'));        $date = new DateTime($request->get('startDate'));        $time = new DateTime($request->get('startTime'));        $mergeStart = new DateTime($date->format('Y-m-d') .' ' .$time->format('H:i:s'));        $t = $request->input('isType2');        if(isset($t) && $t != ""){            $t = $request->input('isType2');        }else{            $t = $request->input('isType');        }        $task = new Task([            'title' => $taskTitle,            'content'=> $request->get('content'),            'deadline'=> $mergeEnd->format('Y-m-d H:i:s'),//$request->get('endDate'),            'startDate'=> $mergeStart->format('Y-m-d H:i:s'),//$request->get('startDate'),            'reTask'=> $request->get('reTask'),            'orderTask'=> $request->get('orderTask'),            'weight'=> $request->get('weight'),            'brand'=> $request->get('brand'),            'material'=> $request->get('material'),            'dx'=> $request->get('dx'),            'dy'=> $request->get('dy'),            'dz'=> $request->get('dz'),            'dDesc'=> $request->get('dDesc'),            'type'=> $t,            'forProduct'=> $request->get('forProduct'),            'user_id'=> Auth::user()->id        ]);        if(!empty($request->pic)) {            $picName = $task->id . '_avatar' . time() . '.' . request()->pic->getClientOriginalExtension();            $request->pic->storeAs('uploads', $picName);            $task->pic = $picName;        }        $task->save();        $task->categories()->attach($request->categories);        $task->categories()->attach($request->categorieschild);        $task->users()->attach($request->users);        if($files=$request->file('medias')){            foreach($files as $file){                $name=$file->getClientOriginalName();                $file->move('imagex',$name);                $images[]=$name;            }        }        /*Insert your data*/        Media::insert( [            'name'=>  implode("|",$images),            'user_id' => Auth::user()->id,            'task_id' => $task->id,            //you can put other insertion here        ]);//        $users = $request->input('users');//        $users = implode(',', $users);//        $input['users'] = $users;//        $task->users()->attach($input);////        $categories = $request->input('categories');//        $categories = implode(',', $categories);//        //$input = $request->except('categories');//        $input['categories'] = $categories;//        $task->categories()->attach($input);        //$task->categories()->attach($request->categories, false);        //        $user->roles()->attach([        //            1 => ['expires' => $expires],        //            2 => ['expires' => $expires]        //        ]);        return redirect('/tasks')->with('success', 'Task has been added');    }    /**     * Display the specified resource.     *     * @param  \App\Task  $task     * @return \Illuminate\Http\Response     */    public function show($id)    {        //$feeds = Feed::with('comments', 'user')->where('user_id', Sentinel::getUser()->id)->latest()->get();        //$commentd = Comment::latest();        //return view('action.index', compact('feeds', 'blogs'));        $user = Auth::user();        //$comments = Task::find($id)->comments;        //$user = User::with('user_id')->where('user_id', '=', $comments->user_id)->get();        //$comments = Comment::all()->where('task_id',$id);        //$user=User::all()->get();        $task = Task::find($id);        $comments = $task->comments()->with('user')->orderBy('created_at','DESC')->get();        $dateBefore = Carbon::now();        foreach ($comments as $key => $loop){            $loop->jCreated_at = new Verta($loop->created_at);            $loop->diff = verta($loop->created_at)->formatDifference();            $loop->diffM = abs(Carbon::parse($loop->created_at)->diffInMinutes($dateBefore, false));        }        //$comments = $task->comments;        $dead = Carbon::now()->diffInDays($task->deadline, false);        $task->increment('viewCount');        $task->jStartDate = new Verta($task->startDate);        $task->jDeadline = new Verta($task->deadline);        $taskMeter = TaskMeter::where('task_id', $id)->orderBy('created_at','DESC')->first();        $taskMeters = TaskMeter::where('task_id', $id)->orderBy('id','ASC')->get();        $dateBefore = Carbon::now();        foreach ($taskMeters as $key => $loop)        {            $loop->diffH = abs(Carbon::parse($loop->created_at)->diffInHours($dateBefore, false));            $loop->diffM = abs(Carbon::parse($loop->created_at)->diffInMinutes($dateBefore, false));            $loop->diffS = abs(Carbon::parse($loop->created_at)->diffInSeconds($dateBefore, false));            $v = new Verta($loop->created_at);            $loop->jDate = $v->year . "." . $v->month . "." . $v->day;            $dateBefore = $loop->created_at;        }        $admin = User::find($task->user_id);        $users = $task->users()->where('task_id',$id)->get();        return view('tasks.show', compact('task','comments', 'dead','user','taskMeter','taskMeters','users','admin'));    }    public function edit($id)    {        $task = Task::find($id);        $brands = Brand::all();        $users_old = $task->users()->where('task_id',$id)->get();        $users = User::all();        $nowDate = new Verta($task->startDate);        $jStart = $nowDate->year . "/" . $nowDate->month . "/" . $nowDate->day;        $nowDate = new Verta($task->deadline);        $jEnd = $nowDate->year . "/" . $nowDate->month . "/" . $nowDate->day;        $urlP = url()->previous();        return view('tasks.edit', compact('task', 'brands','users','users_old','jEnd','jStart','urlP'));    }    public function update(Request $request, $id)    {        $request->validate([            'title'=>'required',            'content'=> 'required'        ]);        $date = new DateTime($request->get('endDate'));        $time = new DateTime($request->get('endTime'));        $mergeEnd = new DateTime($date->format('Y-m-d') .' ' .$time->format('H:i:s'));        $date = new DateTime($request->get('startDate'));        $time = new DateTime($request->get('startTime'));        $mergeStart = new DateTime($date->format('Y-m-d') .' ' .$time->format('H:i:s'));        $task = Task::find($id);        $task->deadline = $mergeEnd;        $task->startDate = $mergeStart;        $task->reTask = $request->get('reTask');        $task->orderTask = $request->get('orderTask');        $task->weight = $request->get('weight');        $task->brand = $request->get('brand');        $task->material = $request->get('material');        $task->dx = $request->get('dx');        $task->dy = $request->get('dy');        $task->dz = $request->get('dz');        $task->dDesc = $request->get('dDesc');        $task->type = $request->get('isType');        $task->forProduct = $request->get('forProduct');        $task->title = $request->get('title');        $task->content = $request->get('content');        $task->save();        $task->users()->sync($request->get('users'));        $urlP = $request->get('urlP');        return redirect($urlP)->with('success', 'Task has been updated');    }    public function done(Request $request)    {        $task = Task::find($request->id);        $task->isDone = $request->isDone;        $task->done_user_id = $request->done_user_id;        $task->done_date = Carbon::now();        $task->save();        return redirect()->back();    }    /**     * Remove the specified resource from storage.     *     * @param  \App\Task  $task     * @return \Illuminate\Http\Response     */    public function modir()    {        $user = Auth::user();        $users = User::all();        $comments = Comment::orderBy('created_at' , 'DESC');        $taskMeters = TaskMeter::orderBy('created_at' , 'DESC');        $tasks = Task::where('isDone', '0')->orderBy('created_at','DESC')->paginate(10);        foreach ($tasks as $key => $loop)        {            date_default_timezone_set("Asia/Tehran");            $loop->nowt = "The time is " . date("h:i:sa");            $loop->rightNow = Carbon::now()->diffInMinutes($loop->deadline, false);            $loop->diffDead = verta($loop->deadline)->formatDifference();            $loop->passNow = abs(Carbon::now()->diffInDays($loop->startDate, false));            $loop->passNowHours = abs(Carbon::now()->diffInMinutes($loop->startDate, false));            $loop->diffDate = abs(Carbon::parse($loop->startDate)->diffInMinutes($loop->deadline, false)) + 1;            $diffdiff = (($loop->passNowHours) * 100) / ($loop->diffDate);            $loop->prog = floor($diffdiff);            $v = new Verta($loop->startDate);            $loop->jStart = $v->year . "/" . $v->month . "/" . $v->day;            $v = new Verta($loop->deadline);            $loop->jEnd = $v->year . "/" . $v->month . "/" . $v->day;        }        return view('tasks.modir', compact('tasks','users','user','taskMeters','comments'));    }    public function modirUser($id)    {        $user = User::find($id);        $comments = Comment::orderBy('created_at' , 'DESC');        $taskMeters = TaskMeter::where('user_id',$id)->orderBy('created_at' , 'DESC');        $users = User::all();        $tasks = $user->tasks()->where('isDone', '0')->orderBy('created_at','DESC')->paginate(10);        foreach ($tasks as $key => $loop)        {            date_default_timezone_set("Asia/Tehran");            $loop->nowt = "The time is " . date("h:i:sa");            $loop->rightNow = Carbon::now()->diffInMinutes($loop->deadline, false);            $loop->diffDead = verta($loop->deadline)->formatDifference();            $loop->passNow = abs(Carbon::now()->diffInDays($loop->startDate, false));            $loop->passNowHours = abs(Carbon::now()->diffInMinutes($loop->startDate, false));            $loop->diffDate = abs(Carbon::parse($loop->startDate)->diffInMinutes($loop->deadline, false)) + 1;            $diffdiff = (($loop->passNowHours) * 100) / ($loop->diffDate);            $loop->prog = floor($diffdiff);            $v = new Verta($loop->startDate);            $loop->jStart = $v->year . "/" . $v->month . "/" . $v->day;            $v = new Verta($loop->deadline);            $loop->jEnd = $v->year . "/" . $v->month . "/" . $v->day;        }        $title = $user->name;        return view('tasks.modir', compact('tasks','users','user','taskMeters','comments','title'));    }    public function destroy($id)    {        $task = Task::find($id);        $task->delete();        return redirect('/tasks')->with('success', 'Task has been deleted Successfully');    }}