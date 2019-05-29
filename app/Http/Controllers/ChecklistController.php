<?php

namespace App\Http\Controllers;

use App\Checklist;
use App\Status;
use App\User;
use Carbon\Carbon;
use Hekmatinasser\Verta\Verta;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class ChecklistController extends Controller
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

        $checklists = Checklist::all();
        return view('checklists.index',compact('checklists','myTasksStatus','usersStatus','statusesToMe'));
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

        $checklist = new Checklist([
            'content'   => $request->get('content'),
            'task_id'   => $request->get('task_id'),
            'user_id'   => $user->id,
            'type'   => $request->get('type'),
            'CheckListStatus'   => $request->get('CheckListStatus'),

        ]);
        $checklist->save();
//        return back()->with('success', 'Done');
        return response()->json([
            'error' => false,
            'checklist'  => $checklist,
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Checklist  $checkList
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $checklist = Checklist::find($id);

        return response()->json([
            'error' => false,
            'checklist'  => $checklist,
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Checklist  $checkList
     * @return \Illuminate\Http\Response
     */
    public function edit(Checklist $checkList)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Checklist  $checkList
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'content'=>'required'
        ]);
        $checklist = Checklist::find($id);
        $checklist->content = $request->input('content');
        $checklist->save();
//        return back()->with('success', 'Done');

        return response()->json([
            'error' => false,
            'checklist'  => $checklist,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Checklist  $checkList
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $checklist = Checklist::find($id);

        return response()->json([
            'error' => false,
            'checklist'  => $checklist,
        ], 200);
    }
}
