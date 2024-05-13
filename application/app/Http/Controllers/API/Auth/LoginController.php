<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\Auth\AuthResource;
use App\Services\Auth\LoginServiceInterface;
use App\Http\Responses\FailResponse;
use App\Http\Responses\SuccessResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class LoginController extends Controller
{
    public function __construct(
        private readonly LoginServiceInterface $loginService,
    )
    {
    }

    public function __invoke(LoginRequest $request): JsonResponse
    {
        $authData = $this->loginService->login(
            loginData: $request->validated(),
            ipaddr: $request->ip(),
        );

        return $authData->result !== null
            ? new SuccessResponse(
                data: ['data' => AuthResource::make($authData->user)],
                message: trans('auth.success'),
            )
            : new FailResponse(
                data: [],
                message: trans('auth.failed'),
                status: Response::HTTP_BAD_REQUEST,
            );
    }
}
