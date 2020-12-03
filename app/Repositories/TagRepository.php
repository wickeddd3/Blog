<?php

namespace App\Repositories;

use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\Tag;
use App\Interfaces\TagRepositoryInterface;

class TagRepository implements TagRepositoryInterface
{
    protected $model;

    public function __construct(Tag $tag)
    {
        $this->model = $tag;
    }

    public function all($search)
    {
        $tags = $this->model->latest();
        $tags_count = $tags->count();
        $tags = $tags->paginate(10);

        if($search) {
            $tags = $this->model->where('name', 'LIKE', "%{$search}%");
            $tags_count = $tags->count();
            $tags = $tags->paginate(10);
            $tags->appends(['search' => $search]);
        }

        return ['tags' => $tags, 'tags_count' => $tags_count];
    }

    public function create($request)
    {
        $request->filled('slug') ? $slug = $request->slug : $slug = Str::slug($request->name, '-');

        $this->model->create([
            'name' => $request->name,
            'slug' => $slug,
            'description' => $request->description,
            'created_at' => Carbon::now()
        ]);
    }

    public function find($id)
    {
        return $this->model->findOrFail($id);
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
