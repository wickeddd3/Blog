<?php

namespace App\Repositories\Eloquent;

use App\Repositories\CommentRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CommentRepository implements CommentRepositoryInterface
{
    public function create($request, $post)
    {
        $comment = $post->addComment([
            'message' => $request->message,
            'user_id' => Auth::id(),
            'created_at' => Carbon::now()
        ]);

        return $comment;
    }

    public function show($post)
    {
        return $post->comments()->paginate(8);
    }

    public function update($request, $comment)
    {
        $comment->update([
            'message' => $request->message,
            'updated_at' => Carbon::now()
        ]);
    }

    public function delete($comment)
    {
        $comment->delete();
    }

}
