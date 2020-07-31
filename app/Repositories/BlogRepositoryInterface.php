<?php

namespace App\Repositories;

interface BlogRepositoryInterface
{
    public function all(string $category);

    public function create(object $request);

    public function update(object $request, $post);

    public function search(string $query);
}
