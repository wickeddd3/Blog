<?php

namespace App\Repositories\Eloquent;

use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\Tag;
use App\Repositories\TagRepositoryInterface;

class TagRepository implements TagRepositoryInterface
{
    public function all()
    {
        return Tag::latest()->simplePaginate(10);
    }

    public function create($request)
    {
        $request->filled('slug') ? $slug = $request->slug : $slug = Str::slug($request->name, '-');

        Tag::create([
            'name' => $request->name,
            'slug' => $slug,
            'description' => $request->description,
            'created_at' => Carbon::now()
        ]);
    }

    public function find($id)
    {
        return Tag::findOrFail($id);
    }

    public function update($request, $id)
    {
        $request->filled('slug') ? $slug = $request->slug : $slug = Str::slug($request->name, '-');

        $tag = $this->find($id);

        $tag->name = $request->name;
        $tag->slug = $slug;
        $tag->description = $request->description;
        $tag->updated_at = Carbon::now();
        $tag->save();
    }

    public function delete($id)
    {
        $this->find($id)->delete();
    }

}
