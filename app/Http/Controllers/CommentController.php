<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
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
        $comments = Comment::with('user','tasks')->orderBy('id','DESC')->get();
        $tasks = Task::all();

        return view('comments.index', compact('comments','tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'comment'=>'required'
        ]);
        $comment = new Comment([
            'comment' => $request->get('comment'),
            'user_id'=> $request->get('user_id'),
            'task_id'=> $request->get('task_id')
        ]);
        $comment->save();
        $task_id = $request->input('task_id');

        $task = Task::find($task_id);
        $task->increment('commentCount');

        return back()->with('success', 'Task has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $user = Auth::user();
        $comment = Comment::find($id);
        $dateBefore = Carbon::now();
        $diffM = abs(Carbon::parse($comment->created_at)->diffInMinutes($dateBefore, false));

        if($comment->user_id == $user->id && $diffM <= 5){



            return view('comments.edit', compact('comment','user'));

        }else{
            return redirect()->back();
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {


        $user = Auth::user();
        $comment = Comment::find($id);
        $rep = "/tasks/". $request->input('task_id');

        if($request->input('user_id') == $user->id){
            $comment->comment = $request->input('comment');
            $comment->save();

        }







        return redirect($rep);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
