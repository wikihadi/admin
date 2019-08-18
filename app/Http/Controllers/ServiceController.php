<?php

namespace App\Http\Controllers;

use App\Fin;
use App\Lunch;
use App\Service;
use App\Status;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Hekmatinasser\Verta\Verta;
use Illuminate\Support\Facades\Auth;


class ServiceController extends Controller
{
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
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        //
    }
    public function intercom()
    {
        $intercom = Service::orderBy('tel','asc')->get();
        return view('services.intercom',compact('intercom'));

    }
    public function lunch()
    {
        $lunchList = Lunch::whereDate('day','>=', Carbon::now())->get();

        foreach ($lunchList as $key => $loop){
            $d = $loop->day;
            $loop->jday = verta($d)->formatWord('l dS F');
        }
        return view('services.lunch',compact('lunchList'));

    }
    public function addFood(Request $request){

            $lunch = new Lunch([
                'name'    => $request->get('name'),
                'content'   => $request->get('content'),
                'day'   => $request->get('day'),
            ]);
            $lunch->save();
            $status = new Status([
                'status'    => 'lunch-add',
                'content'   => 'افزودن ناهار',
                'user_id'   => Auth::id(),
            ]);
            $status->save();
        return back();
//        $lunchList = Lunch::whereDate('day','>=', Carbon::now())->get();
//        return $lunchList;

    }
    public function formSubmit(Request $request)
    {
        $imageName = time().'.'.$request->image->getClientOriginalExtension();
        $request->image->move(public_path('storage/uploads'), $imageName);

        return response()->json(['success'=>'You have successfully upload image.']);
    }
    public function finFormSubmit(Request $request)
    {
        $fin = new Fin([
            'price' => $request->price,
            'date' => $request->date,
            'user_id' => $request->user,
            'subject' => $request->subject,
            'brand_id' => $request->brand,
            'content' => $request->contentFin,
        ]);
        $fin->save();


        $status = new Status([
            'status'    => 'fin',
            'content'   => 'ثبت هزینه توسط کاربر ' . $fin->user_id,
            'user_id'   => $fin->user_id,
            'fin_id' => $fin->id,
        ]);
        $status->save();

        if ($request->image!=null){
            $imageName = time().'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('storage/uploads/fin'), $imageName);
            $fin->image=$imageName;
            $fin->save();
        }
        return response()->json(['success'=>$request->image]);
    }
}
