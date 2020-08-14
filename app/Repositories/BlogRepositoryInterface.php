<?php

namespace App\Repositories;

interface BlogRepositoryInterface
{
    public function all(string $category, string $archive);

    public function view(object $post);

    public function create(object $request);

    public function update(object $request, $post);

    public function search(string $query);
}
