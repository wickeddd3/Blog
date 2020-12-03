<?php

namespace App\Interfaces;

interface CommentRepositoryInterface
{
    public function create(object $request, object $post);

    public function show(object $post);

    public function update(object $request, object $comment);

    public function delete(object $comment);
}
