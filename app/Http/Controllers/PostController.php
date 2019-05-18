<?php

namespace App\Http\Controllers;

use App\Post;
use App\PostViewBy;
use App\Status;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
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

        $posts = Post::orderBy('id','DESC')->paginate(10);

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
        $oldView = PostViewBy::where('user_id', $user->id)->where('post_id', $id)->get();
        if(count($oldView) == 0) {
            $postView = new PostViewBy([
                'user_id' => $user->id,
                'user_name' => $user->name,
                'post_id' => $id
            ]);
            $postView->save();
        }
        return view('posts.show', compact('post','myTasksStatus','usersStatus','lastStartedStatus','statusesToMe'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
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
        //
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

    public function verifyPost(Post $post)
    {
        Auth::user()->verify()->attach($post->id);

        return back();
    }
}
