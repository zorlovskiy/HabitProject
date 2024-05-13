<?php

namespace App\Http\Controllers\API\Register;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserCreateRequest;
use App\Http\Resources\User\UserResource;
use App\Http\Responses\FailResponse;
use App\Http\Responses\SuccessResponse;
use App\Services\User\UserServiceInterface;
use Illuminate\Http\JsonResponse;

class RegisterController extends Controller
{
    public function __construct(
        private readonly UserServiceInterface $userService,
    )
    {
    }

    public function __invoke(UserCreateRequest $request): JsonResponse
    {
        $user =$this->userService->create(
            data: $request->validated(),
        );

        return $user
            ? new SuccessResponse(
                data: ['data' => UserResource::make($user)],
                message: trans('user.created', ['username' => $user->username]),
            )
            : new FailResponse(message: trans('user.already_exist'));
    }
}
