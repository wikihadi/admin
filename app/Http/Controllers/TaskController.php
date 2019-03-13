<?php

namespace App\Http\Controllers;

use App\Category;
use App\User;
use App\Comment;
use App\Task;
use App\Brand;
//use http\Client\Curl\User as User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
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
    public function index()
    {
        $id = Auth::user()->id;
        $user = User::find($id);


        $tasks = $user->tasks()->orderBy('deadline','ASC')->paginate(9);
//        $tasks = Task::orderBy('deadline','ASC')->paginate(9);
//        $team = User::with('tasks');
//
        foreach ($tasks as $key => $loop)
        {

            $loop->rightNow = Carbon::now()->diffInDays($loop->deadline, false);
        }

        return view('tasks.index', compact('tasks'));


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('parent_id', '=' , '0')->get();
        $childCategories = Category::where('parent_id', '!=' , '0')->get();
        $users = User::all();
        $brands = Brand::all();
        return view('tasks.create', compact('categories','users', 'childCategories','brands'));

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
            'title'=>'required',
            'content'=> 'required'
        ]);
        $task = new Task([
            'title' => $request->get('title'),
            'content'=> $request->get('content'),
            'deadline'=> $request->get('deadline'),
            'user_id'=> Auth::user()->id
        ]);
        $task->save();
        $task->categories()->attach($request->categories);
        $task->categories()->attach($request->categorieschild);
        $task->users()->attach($request->users);





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

        return redirect('/tasks')->with('success', 'Task has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        //$feeds = Feed::with('comments', 'user')->where('user_id', Sentinel::getUser()->id)->latest()->get();
        //$commentd = Comment::latest();
        //return view('action.index', compact('feeds', 'blogs'));




        //$comments = Task::find($id)->comments;
        //$user = User::with('user_id')->where('user_id', '=', $comments->user_id)->get();

        //$comments = Comment::all()->where('task_id',$id);
        //$user=User::all()->get();
        $task = Task::find($id);
        $comments = $task->comments()->with('user')->get();

        //$comments = $task->comments;
        $dead = Carbon::now()->diffInDays($task->deadline, false);
        $task->increment('viewCount');
        return view('tasks.show', compact('task','comments', 'dead'));


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = Task::find($id);

        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title'=>'required',
            'content'=> 'required'
        ]);

        $task = Task::find($id);
        $task->title = $request->get('title');
        $task->content = $request->get('content');
        $task->save();

        return redirect('/tasks')->with('success', 'Task has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::find($id);
        $task->delete();

        return redirect('/tasks')->with('success', 'Task has been deleted Successfully');
    }
}
