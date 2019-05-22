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

    }

    public function updateAll(Request $request)
    {


        $taskOrders = TaskOrderUser::all();
        foreach ($taskOrders as $to){
            $id = $to->id;
            foreach ($request->order as  $orderFrontEnd){
                if($orderFrontEnd['id'] == $id){
                    $to->update(['order_column' => $orderFrontEnd['order_column']]);
                }
            }
        }
        return response('Updated.', 200);

    }




    public function destroy(Request $request,$id)
    {
        //
    }


}

