<?php

namespace App\Http\Controllers;

use App\PressesLinkOptions;
use App\Press;
use App\PressOption;
use Illuminate\Http\Request;

class PressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('press.index');
    }
    public function fetchPress()
    {
        return Press::all();
    }
    public function pressDel()
    {
        $press = Press::find($_GET['id']);
        $press->delete();
        return $this->fetchPress();
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
    public function addPress(Request $request)
    {
        $press = Press::create($request->all());
if ($request->get('services')!=null){
    $thePostIdArray = explode(',', $request->get('services'));
    foreach ($thePostIdArray as $i){
        $press->options()->attach($i);
    }
}

        if ($request->get('machines')!=null){

        $thePostIdArray = explode(',', $request->get('machines'));
            foreach ($thePostIdArray as $i){
                $press->options()->attach($i);
            }
            }
            if ($request->get('cases')!=null){

                $thePostIdArray = explode(',', $request->get('cases'));
            foreach ($thePostIdArray as $i){
                $press->options()->attach($i);
            }
            }
                if ($request->get('material')!=null){

                    $thePostIdArray = explode(',', $request->get('material'));
            foreach ($thePostIdArray as $i){
                $press->options()->attach($i);
            }
            }




        $press = Press::orderBy('name','asc')->get();
        return $press;
    }

    public function addOptionPress(){
        $type = $_GET['t'];
        $title = $_GET['title'];
        $po = new PressOption([
            'title'    => $title,
            'type'   => $type,
        ]);
        $po->save();
        return $this->fetchOptions();

    }

    public function fetchOptions(){
        $services = PressOption::where('type','service')->orderBy('title','asc')->get();
        $machines = PressOption::where('type','machine')->orderBy('title','asc')->get();
        $cases = PressOption::where('type','case')->orderBy('title','asc')->get();
        $material = PressOption::where('type','material')->orderBy('title','asc')->get();

        return response()->json([
            'services' => $services,
            'machines' => $machines,
            'cases' => $cases,
            'material' => $material,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Press  $press
     * @return \Illuminate\Http\Response
     */
    public function show(Press $press)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Press  $press
     * @return \Illuminate\Http\Response
     */
    public function edit(Press $press)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Press  $press
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Press $press)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Press  $press
     * @return \Illuminate\Http\Response
     */
    public function destroy(Press $press)
    {
        //
    }


}
