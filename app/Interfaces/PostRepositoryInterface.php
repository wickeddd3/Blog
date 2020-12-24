<?php

namespace App\Interfaces;

interface PostRepositoryInterface
{
    public function all(string $search);

    public function publish(int $id);

    public function feature(int $id);

    public function unfeature(int $id);

    public function trash(int $id);

    public function restore(int $id);

    public function delete(int $id);

}
