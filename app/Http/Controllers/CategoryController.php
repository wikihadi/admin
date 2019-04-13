<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');

        $this->middleware('permission:category-list');
        $this->middleware('permission:category-create', ['only' => ['create','store']]);
        $this->middleware('permission:category-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:category-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
                $categories = Category::all();
                return view('categories.create', compact('categories'));
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
        $request->validate([
            'title'=>'required'
        ]);
        $category = new Category([
            'title' => $request->get('title'),
            'parent_id'=> $request->get('parent_id'),
            'isMaterial'=> $request->get('isMaterial'),
            'isDimension'=> $request->get('isDimension'),
            'isType'=> $request->get('isType'),
            'description'=> $request->get('description')
        ]);
        $category->save();
        return back()->with('success', 'Task has been added');
    }


    public function materials()
    {
        $material = -1;
        $categories = Category::where('isMaterial', '=' , '1')->get();
        return view('categories.create', compact('categories','material'));
    }
    public function dimensions()
    {
        $material = -1;
        $dimen = -1;
        $categories = Category::where('isDimension', '=' , '1')->get();
        return view('categories.create', compact('categories','material', 'dimen'));
    }
    public function types()
    {
        $material = -1;
        $type = -1;
        $categories = Category::where('isType', '=' , '1')->get();
        return view('categories.create', compact('categories','material', 'type'));
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
    }
}
