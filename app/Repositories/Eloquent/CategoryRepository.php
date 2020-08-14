<?php

namespace App\Repositories\Eloquent;

use App\Repositories\CategoryRepositoryInterface;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Support\Str;

class CategoryRepository implements CategoryRepositoryInterface
{
    protected $model;

    public function __construct(Category $category)
    {
        $this->model = $category;
    }

    public function all($search)
    {
        $categories =  $this->model->latest();
        $categories_count = $categories->count();
        $categories = $categories->paginate(10);

        if($search) {
            $categories = $this->model->where('name', 'LIKE', "%{$search}%");
            $categories_count = $categories->count();
            $categories = $categories->paginate(10);
            $categories->appends(['search' => $search]);
        }

        return ['categories' => $categories, 'categories_count' => $categories_count];
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

        $category = $this->find($id);

        $category->name = $request->name;
        $category->slug = $slug;
        $category->description = $request->description;
        $category->updated_at = Carbon::now();
        $category->save();
    }

    public function delete($id)
    {
        $this->find($id)->delete();
    }

}
