<?php

namespace App\Services\Auth;

use App\Services\User\UserServiceInterface;
use App\Utils\Auth\LoginDTO;
use Illuminate\Support\Facades\Hash;

class LoginService implements LoginServiceInterface
{
    public function __construct(
        private readonly UserServiceInterface $userService,
    )
    {
    }

    public function login(array $loginData, string $ipaddr): LoginDTO
    {
        $user = $this->userService->getUser($loginData['email']);
        if ($user && Hash::check($loginData['password'], $user->password)) {

            $comment = trans('успешно найден');

            return new LoginDTO(true, $user, $comment);
        }

        return new LoginDTO();
    }
}
