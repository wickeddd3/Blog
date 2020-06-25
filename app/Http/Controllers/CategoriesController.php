<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Category;
use Carbon\Carbon;

class CategoriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.category.index')->with('categories', Category::latest()->simplePaginate(10));
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
            'name' => 'required|max:255|unique:categories,name',
            //'slug' => 'required|max:255|unique:categories,slug',
        ]);

        $request->filled('slug') ? $slug = $request->slug : $slug = Str::slug($request->name, '-');

        Category::create([
            'name' => $request->name,
            'slug' => $slug,
            'description' => $request->description,
            'created_at' => Carbon::now()
        ]);

        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('dashboard.category.edit')->with('category', Category::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //return dd($request->all());
        $request->validate([
            'name' => 'required|max:255|unique:categories,name,'.$id,
            //'slug' => 'required|max:255|unique:categories,slug,'.$id,
        ]);

        $request->filled('slug') ? $slug = $request->slug : $slug = Str::slug($request->name, '-');

        $category = Category::findOrFail($id);

        $category->name = $request->name;
        $category->slug = $slug;
        $category->description = $request->description;
        $category->updated_at = Carbon::now();
        $category->save();

        return redirect()->route('categories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::findOrFail($id)->delete();

        return redirect()->back();
    }
}
