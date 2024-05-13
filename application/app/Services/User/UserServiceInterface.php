<?php

namespace App\Services\User;

use App\Models\User;

interface UserServiceInterface
{
    public function create(array $data): ?User;
    public function getUser(string $email): ?User;
}
