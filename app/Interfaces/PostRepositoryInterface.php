<?php

namespace App\Interfaces;

interface PostRepositoryInterface
{
    public function all(string $search);

    public function feature(int $id);

    public function unfeature(int $id);
}
