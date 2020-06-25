<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Tag;

class TagsController extends Controller
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
        return view('dashboard.tag.index')->with('tags', Tag::latest()->simplePaginate(10));
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
            'name' => 'required|max:255|unique:tags,name'
        ]);

        $request->filled('slug') ? $slug = $request->slug : $slug = Str::slug($request->name, '-');

        Tag::create([
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
        return view('dashboard.tag.edit')->with('tag', Tag::findOrFail($id));
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
            'name' => 'required|max:255|unique:tags,name,'.$id,
            //'slug' => 'required|max:255|unique:tags,slug,'.$id,
        ]);

        $request->filled('slug') ? $slug = $request->slug : $slug = Str::slug($request->name, '-');

        $tag = Tag::findOrFail($id);

        $tag->name = $request->name;
        $tag->slug = $slug;
        $tag->description = $request->description;
        $tag->updated_at = Carbon::now();
        $tag->save();

        return redirect()->route('tags');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Tag::findOrFail($id)->delete();

        return redirect()->back();
    }
}
