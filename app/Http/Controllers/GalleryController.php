<?php

namespace App\Http\Controllers;

use App\Gallery;
use App\Status;
use Hekmatinasser\Verta\Verta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gallery = Gallery::with('user','task')->latest()->paginate(12);
        foreach ($gallery as $key => $loop){
            $loop->jCreated_at = new Verta($loop->created_at);
            $loop->diff = verta($loop->created_at)->formatDifference();
        }
        return view('gallery.index',compact('gallery'));
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
            'pic' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5000',
            'content'=> 'required'
        ]);

        $gallery = new Gallery([
            'content'=> $request->get('content'),
            'user_id'=> Auth::id(),
            'task_id'=> $request->get('task'),
        ]);

        if(!empty($request->pic)) {
            $picName = 'gallery' . time() . '.' . request()->pic->getClientOriginalExtension();
            $request->pic->storeAs('uploads/gallery', $picName);
            $gallery->pic = $picName;
        }
        $gallery->save();

        $status = new Status([
            'status'    => 'new-pic',
            'content'   => $request->get('content'),
            'task_id'   => $request->get('task'),
            'gallery_id'   => $gallery->id,
            'user_id'   => $request->get('user'),
        ]);
        $status->save();

//        $url = '/tasks/'.$request->get('task');
        $url = '/';

        return redirect($url)->with('success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function show(Gallery $gallery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function edit(Gallery $gallery)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gallery $gallery)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gallery $gallery)
    {
        //
    }
    public function fetchGallery()
    {
        $gallery = Gallery::where('task_id',$_GET['task'])->latest()->get();
        return $gallery;
    }
    public function delGallery()
    {
        $gal = Gallery::find($_GET['gal']);
        $gal->delete();
        $status = Status::where('gallery_id',$gal->id)->first();
        $status->delete();
        $gallery = Gallery::where('task_id',$_GET['task'])->latest()->get();
        return $gallery;
    }
    public function starGallery()
    {
        $gal = Gallery::find($_GET['gal']);
        if ($gal->star==0){
            $gal->star=1;
        }elseif ($gal->star==1){
            $gal->star=0;
        }

        $gal->save();
        $gallery = Gallery::where('task_id',$_GET['task'])->latest()->get();
        return $gallery;
    }
}
