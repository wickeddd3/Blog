<?php

namespace App\Repositories;

interface PostRepositoryInterface
{
    public function all(string $filter);

    public function create(object $request);

    public function find(int $id);

    public function update(object $request, int $id);

    public function publish(int $id);

    public function feature(int $id);

    public function trash(int $id);

    public function restore(int $id);

    public function delete(int $id);

}
