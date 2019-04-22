<?php

namespace App\Http\Controllers;

use App\Post;
use App\PostViewBy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('id','DESC')->paginate(10);

        return view('posts.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');

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
        return redirect()->back()->with('success', 'Post has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
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
        return view('posts.show', compact('post'));
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
