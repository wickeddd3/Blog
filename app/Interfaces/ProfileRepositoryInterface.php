<?php

namespace App\Interfaces;

interface ProfileRepositoryInterface
{
    public function update(object $request);

    public function filter(object $user, string $filter);

    public function notifications();

    public function markAsRead(string $user, object $request);

}
