<?php

namespace App\Repositories;

interface ProfileRepositoryInterface
{
    public function authUser();

    public function update(object $request);

    public function filter(string $user, string $filter);

    public function notifications();

    public function markAsRead(string $user, object $request);

}
