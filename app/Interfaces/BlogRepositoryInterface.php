<?php

namespace App\Interfaces;

interface BlogRepositoryInterface
{
    public function all(string $category, string $filter);

    public function view(object $post);

    public function store(object $request);

    public function update(object $request, $post);

    public function search(string $query);
}
