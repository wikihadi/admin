<?php

namespace App\Http\Controllers;

use App\Notifications\NewPost;
use App\Post;
use App\PostViewBy;
use App\Status;
use App\User;
use Carbon\Carbon;
use foo\bar;
use Illuminate\Http\Request;
use Notification;
use Illuminate\Support\Facades\Auth;
use Verta;


class PostController extends Controller
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
        $lastStartedStatus = Status::with('user')->where('user_id',$user->id)->where('status','start')->orWhere('status','end')->orderBy('created_at','desc')->first();


        $posts = Post::where('published',1)->latest()->get();

        return view('posts.index',compact('posts','myTasksStatus','usersStatus','myTasksStatus','usersStatus','lastStartedStatus','statusesToMe'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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



        return view('posts.create', compact('myTasksStatus','usersStatus','lastStartedStatus','statusesToMe'));

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
        $post = new Post([
            'title' => $request->get('title'),
            'content'=> $request->get('content'),
            'section'=> $request->get('section'),
            'user_id'=> $request->get('user_id'),
            'published'=> $request->get('published')
        ]);

        $post->save();

//        if (!empty($request->get('emailPost')) && $request->get('emailPost') == 1){
            $users = User::find(1);
            Notification::send($users, new NewPost($post));
//        }
//

        return redirect()->back()->with('success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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

        $post = Post::find($id);
        $user = Auth::user();
        $statusPost =   Status::where('status','verifyPost')->where('user_id',$user->id)->where('post_id',$post->id)->get();
        $usersRead =    Status::with('user')->whereHas('user')->where('status','verifyPost')->where('post_id',$post->id)->get();
        if (count($statusPost) == 0){
            $read = 0;
        }else{
            $read = 1;
        }


        return view('posts.show', compact('usersRead','post','myTasksStatus','usersStatus','lastStartedStatus','statusesToMe','read'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
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

        $post = Post::find($post)->first();
        return view('posts.edit', compact('post','myTasksStatus','usersStatus','lastStartedStatus','statusesToMe'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $post->title        =   $request->input('title');
        $post->content      =   $request->input('content');
        $post->section      =   $request->input('section');
        $post->published    =   $request->input('published');
        $post->save();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
    public function fetchPosts()
    {
        $role = $_GET['role'];
        $rolePost = $_GET['rolePost'];
        $user_id = $_GET['user'];

        if ($role=='admin'||$role=='modir'){
            if($rolePost!='all'&&$rolePost!='draft'){
                $posts = Post::where('published',1)->where('section',$rolePost)->latest()->get();
            }elseif($rolePost=='all'){
                $posts = Post::where('published',1)->latest()->get();
            }elseif($rolePost=='draft'){
                $posts = Post::where('published',0)->latest()->get();
            }
        }elseif ($role=='designer'){
            if($rolePost!='all'){
                $posts = Post::where('published',1)->where('section',$rolePost)->latest()->get();
            }else{
                $posts = Post::where('published',1)->whereIn('section',['عمومی','طراحی'])->latest()->get();
            }
        }elseif ($role=='finance'){
            if($rolePost!='all'){
                $posts = Post::where('published',1)->where('section',$rolePost)->latest()->get();
            }else{
                $posts = Post::where('published',1)->whereIn('section',['عمومی','مالی'])->latest()->get();
            }
        }
        foreach ($posts as $key => $loop) {
            $statusPost = Status::where('status','verifyPost')->where('user_id',$user_id)->where('post_id',$loop->id)->get();
            if (count($statusPost) == 0){
                $loop->read = 0;
            }else{
                $loop->read = 1;
            }
        }
        return  $posts;
    }


}
