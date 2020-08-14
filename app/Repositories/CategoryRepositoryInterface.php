<?php

namespace App\Repositories;

interface CategoryRepositoryInterface
{
    public function all(string $search);

    public function create(object $request);

    public function find(int $id);

    public function update(object $request, int $id);

    public function delete(int $id);
}
