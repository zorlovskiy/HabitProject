<?php

namespace App\Http\Resources\Auth;

use Illuminate\Http\Resources\Json\JsonResource;

class AuthResource extends JsonResource
{
    private const LOCAL_AUTH = "auth-token";

    public function toArray($request): array
    {
        return [
            'user' => AuthUserResource::make($this),
            'token' => $this->createToken(self::LOCAL_AUTH)->plainTextToken,
        ];
    }
}
