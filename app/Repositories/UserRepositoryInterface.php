<?php

namespace App\Repositories;

interface UserRepositoryInterface
{
    public function all(string $search);

    public function create(object $request);

    public function find(int $id);

    public function update(object $request, int $id);
}
