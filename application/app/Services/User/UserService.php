<?php

namespace App\Services\User;

use App\Models\User;
use Illuminate\Support\Facades\Log;

class UserService implements UserServiceInterface
{

    public function create(array $data): ?User
    {
        /** @var User $user */
        $user = null;

        try {
                $user = User::query()->create([
                    ...$data,
                ]);

        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return null;
        }

        return $user;
    }

    public function getUser(string $email): ?User
    {
        /** @var User $user */
        $user = User::query()->where('email', $email)->first();
        return $user;
    }
}
