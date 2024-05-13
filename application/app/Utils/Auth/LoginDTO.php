<?php

namespace App\Utils\Auth;

use App\Models\User;

class LoginDTO
{
    public function __construct(
        public ?bool   $result = null,
        public ?User   $user = null,
        public ?string $comment = null,
        public ?string $token = null,
    )
    {
    }
}
