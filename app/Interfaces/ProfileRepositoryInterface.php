<?php

namespace App\Interfaces;

interface ProfileRepositoryInterface
{
    public function update(object $request);

    public function filter(object $user, string $filter);

    public function notifications();

    public function markAsRead(string $user, object $request);

    public function publish(int $id);

    public function trash(int $id);

    public function restore(int $id);

    public function delete(int $id);
}
