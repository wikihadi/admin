<?php

namespace App\Http\Controllers;

use App\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$medias = Media::all();
        return view('medias.index');
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

        $file = $request->file('file');
        $path = $request->file->store('the/path');

//        $imageName = request()->file->getClientOriginalName();
//        request()->file->move(public_path('upload'), $imageName);
//
//
//        return response()->json(['uploaded' => '/upload/'.$imageName]);


//        $this->validate($request, [
//
//            'media' => 'required',
//            'media.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
//
//        ]);
//
//        if($request->hasfile('media'))
//        {
//
//            foreach($request->file('media') as $image)
//            {
//                $name=$image->getClientOriginalName();
//                $image->move(public_path().'/images/', $name);
//                $data[] = $name;
//            }
//        }
//
//        $form= new Media();
//        $form->user_id = Auth::user()->id;
//        $form->name =json_encode($data);
//
//
//        $form->save();
//
//        return back()->with('success', 'Your images has been successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function show(Media $media)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function edit(Media $media)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Media $media)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function destroy(Media $media)
    {
        //
    }
}
