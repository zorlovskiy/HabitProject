<?php

namespace App\Services\Auth;

use App\Utils\Auth\LoginDTO;

interface LoginServiceInterface
{
    public function login(array $loginData, string $ipaddr): LoginDTO;
}
