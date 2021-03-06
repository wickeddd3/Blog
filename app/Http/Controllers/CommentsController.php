<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentStoreRequest;
use App\Http\Requests\CommentUpdateRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Comment;
use App\Interfaces\CommentRepositoryInterface;

class CommentsController extends Controller
{
    protected $commentRepository;

    public function __construct(CommentRepositoryInterface $commentRepository)
    {
        $this->middleware(['auth', 'verified'])->except('show');

        $this->commentRepository = $commentRepository;
    }

    public function store(Category $category, Post $post, CommentStoreRequest $request)
    {
        $comment = $this->commentRepository->create($request, $post);

        if(request()->expectsJson()) {
            return $comment->load('owner');
        }

    }

    public function show(Category $category, Post $post)
    {
        return $this->commentRepository->show($post);
    }

    public function update(CommentUpdateRequest $request, Comment $comment)
    {
        $this->commentRepository->update($request, $comment);
    }

    public function destroy(Comment $comment)
    {
        $this->commentRepository->delete($comment);

        if(request()->expectsJson()) {
            return response(['status' => 'comment deleted']);
        }

        return back();
    }
}
