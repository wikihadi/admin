<?php

namespace App\Http\Controllers;

use App\TaskOrderUser;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Validator;
use Response;

class TaskOrderUserController extends Controller
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
//
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
//
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
//
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
        $user_id = $request->get('user_id');
        $ordering = $request->get('ordering');
        $lastOrder = TaskOrderUser::where('user_id',$user_id)->orderBy('order_column','desc')->first();
        $item = TaskOrderUser::firstOrNew([
            'task_id' => $id,
            'user_id' => $user_id

        ], [
            'task_id' => $id,
            'user_id' => $user_id
        ]);
        //$item = TaskOrderUser::where('task_id',$id)->where('user_id',$user_id)->first();
        if (empty($lastOrder)){
            $x = 0;
        }else{
            $x = $lastOrder->order_column;
        }
        if ($item->order_column <= 0){
            $item->order_column = $x + 1;
            $item->save();

            return redirect()->back();
        }else{
            if ($ordering == 'plus') {
                if ($item->order_column >= $lastOrder->order_column) {
                    $item->save();

                    return redirect()->back();
                }else{
                    $oldOrder = TaskOrderUser::where('order_column', $item->order_column + 1)->first();
                    if (!empty($oldOrder)) {
                        $item->order_column += 1;
                        $oldOrder->order_column -= 1;
                        $oldOrder->save();
                    }
                }
            }elseif ($ordering == 'minus'){
                $oldOrder = TaskOrderUser::where('order_column', $item->order_column - 1)->first();
                    if(!empty($oldOrder)) {
                    $oldOrder->order_column += 1;
                    $oldOrder->save();
                    $item->order_column -= 1;
                }

            }
            $item->save();

            return redirect()->back();
        }


    }

    public function updateAll(Request $request)
    {

        dd($request->order);

        return response('Updated.', 200);

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        //
    }
//    public function up(Request $request)
//    {
//
//        $user_id = $request->user_id;
//        $user = User::find($user_id);
//        $task_id = Input::get('id');
//        $ordering = $request->ordering;
//        $lastOrder = TaskOrderUser::where('user_id',$user_id)->orderBy('order_column','desc')->first();
//        $item = TaskOrderUser::firstOrNew([
//            'task_id' => $task_id,
//            'user_id' => $user_id
//
//        ], [
//            'task_id' => $task_id,
//            'user_id' => $user_id
//        ]);
//        if (empty($lastOrder)){
//            $x = 0;
//        }else{
//            $x = $lastOrder->order_column;
//        }
//        if ($item->order_column <= 0){
//            $item->order_column = $x + 1;
//            $item->save();
//            $tasks = $user->taskOrder()->where('isDone', '0')->where('pending','0')->orderBy('updated_at','DESC')->paginate(200);
//
//            return response()->json($tasks);
//        }else{
//            if ($ordering == 'plus') {
//                if ($item->order_column >= $lastOrder->order_column) {
//                    $item->save();
//                    $tasks = $user->taskOrder()->where('isDone', '0')->where('pending','0')->orderBy('updated_at','DESC')->paginate(200);
//
//                    return response()->json($tasks);
//                }else{
//                    $oldOrder = TaskOrderUser::where('order_column', $item->order_column + 1)->first();
//                    if (!empty($oldOrder)) {
//                        $item->order_column += 1;
//                        $oldOrder->order_column -= 1;
//                        $oldOrder->save();
//                    }
//                }
//            }elseif ($ordering == 'minus'){
//                $oldOrder = TaskOrderUser::where('order_column', $item->order_column - 1)->first();
//                if(!empty($oldOrder)) {
//                    $oldOrder->order_column += 1;
//                    $oldOrder->save();
//                    $item->order_column -= 1;
//                }
//
//            }
//            $item->save();
//            $tasks = $user->taskOrder()->where('isDone', '0')->where('pending','0')->orderBy('updated_at','DESC')->paginate(200);
//
//            return response()->json($tasks);
//        }
//
//
//    }
}

