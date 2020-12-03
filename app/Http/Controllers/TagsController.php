<?php

namespace App\Http\Controllers;

use App\Http\Requests\TagStoreRequest;
use App\Http\Requests\TagUpdateRequest;
use App\Interfaces\TagRepositoryInterface;

class TagsController extends Controller
{
    protected $tagRepository;

    public function __construct(TagRepositoryInterface $tagRepository)
    {
        $this->middleware(['auth', 'verified']);

        $this->tagRepository = $tagRepository;
    }

    public function index()
    {
        $result = $this->tagRepository->all(request()->query('search'));

        if(request()->wantsJson()) {
            return response()->json([
                'tags' => $result['tags'],
                'tags_count' => $result['tags_count']
            ]);
        }
        return view('dashboard.tag.index');
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
