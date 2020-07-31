<?php

namespace App\Repositories\Eloquent;

use App\Repositories\CategoryRepositoryInterface;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Support\Str;

class CategoryRepository implements CategoryRepositoryInterface
{
    protected $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function all()
    {
        return Category::latest()->simplePaginate(10);
    }

    public function create($request)
    {
        $request->filled('slug') ? $slug = $request->slug : $slug = Str::slug($request->name, '-');

        Category::create([
            'name' => $request->name,
            'slug' => $slug,
            'description' => $request->description,
            'created_at' => Carbon::now()
        ]);
    }

    public function find($id)
    {
        return Category::findOrFail($id);
    }

    public function update($request, $id)
    {
        $request->filled('slug') ? $slug = $request->slug : $slug = Str::slug($request->name, '-');

        $category = Category::findOrFail($id);

        $category->name = $request->name;
        $category->slug = $slug;
        $category->description = $request->description;
        $category->updated_at = Carbon::now();
        $category->save();
    }

    public function delete($id)
    {
        Category::findOrFail($id)->delete();
    }

}
