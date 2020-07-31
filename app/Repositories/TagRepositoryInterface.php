<?php

namespace App\Repositories;

interface TagRepositoryInterface
{
    public function all();

    public function create(object $request);

    public function find(int $id);

    public function update(object $request, int $id);

    public function delete(int $id);
}
