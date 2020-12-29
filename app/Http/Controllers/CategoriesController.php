<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Interfaces\CategoryRepositoryInterface;

class CategoriesController extends Controller
{
    protected $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->middleware(['auth', 'verified']);

        $this->categoryRepository = $categoryRepository;
    }

    public function index()
    {
        $result = $this->categoryRepository->all(request()->query('search'));

        if(request()->wantsJson()) {
            return response()->json([
                'categories' => $result['categories'],
                'categories_count' => $result['categories_count']
            ]);
        }

        return view('dashboard.category.index');
    }

    public function store(CategoryStoreRequest $request)
    {
        $this->categoryRepository->create($request);

        return redirect()->back();
    }

    public function edit($id)
    {
        $category = $this->categoryRepository->find($id);

        return view('dashboard.category.edit')->with('category', $category);
    }

    public function update(CategoryUpdateRequest $request, $id)
    {
        $this->categoryRepository->update($request, $id);

        return redirect()->route('dashboard.categories.index');
    }

    public function destroy($id)
    {
        return $this->categoryRepository->delete($id);
    }
}
