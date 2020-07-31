<?php

namespace App\Http\Controllers;

use App\Http\Requests\TagStoreRequest;
use App\Http\Requests\TagUpdateRequest;
use App\Repositories\TagRepositoryInterface;

class TagsController extends Controller
{
    protected $tagRepository;

    public function __construct(TagRepositoryInterface $tagRepository)
    {
        $this->middleware('auth');

        $this->tagRepository = $tagRepository;
    }

    public function index()
    {
        $tags = $this->tagRepository->all();

        return view('dashboard.tag.index')->with('tags', $tags);
    }

    public function store(TagStoreRequest $request)
    {
        $this->tagRepository->create($request);

        return redirect()->back();
    }

    public function edit($id)
    {
        $tag = $this->tagRepository->find($id);

        return view('dashboard.tag.edit')->with('tag', $tag);
    }

    public function update(TagUpdateRequest $request, $id)
    {
        $this->tagRepository->update($request, $id);

        return redirect()->route('tags');
    }

    public function destroy($id)
    {
        $this->tagRepository->delete($id);

        return redirect()->back();
    }
}
