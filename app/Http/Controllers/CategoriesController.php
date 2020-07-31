<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Repositories\CategoryRepositoryInterface;

class CategoriesController extends Controller
{
    protected $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->middleware('auth');

        $this->categoryRepository = $categoryRepository;
    }

    public function index()
    {
        $categories = $this->categoryRepository->all();

        return view('dashboard.category.index')->with('categories', $categories);
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

        return redirect()->route('categories');
    }

    public function destroy($id)
    {
        $this->categoryRepository->delete($id);

        return redirect()->back();
    }
}
