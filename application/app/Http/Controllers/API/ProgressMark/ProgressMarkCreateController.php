<?php

namespace App\Http\Controllers\API\ProgressMark;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProgressMark\ProgressMarkCreateRequest;
use App\Http\Resources\ProgressMark\ProgressMarkResource;
use App\Http\Responses\FailResponse;
use App\Http\Responses\SuccessResponse;
use App\Services\ProgressMark\ProgressMarkInterface;
use Illuminate\Http\JsonResponse;

class ProgressMarkCreateController extends Controller
{
    public function __construct(
        private readonly ProgressMarkInterface $progressMark
    )
    {
    }

    public function __invoke(ProgressMarkCreateRequest $request): JsonResponse
    {
        $mark = $this->progressMark->create(
            data: $request->validated(),
        );

        return $mark
            ? new SuccessResponse(
                data: ['data' => ProgressMarkResource::make($mark)],
                message: trans('progressMark.created')
            )
            : new FailResponse(message: trans('progressMark.not_created'));
    }
}
