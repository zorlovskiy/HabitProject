<?php

namespace App\Http\Controllers\API\Habit;

use App\Http\Controllers\Controller;
use App\Http\Requests\Habit\HabitCreateRequest;
use App\Http\Resources\Habit\HabitResource;
use App\Http\Responses\FailResponse;
use App\Http\Responses\SuccessResponse;
use App\Services\Habit\HabitServiceInterface;
use Illuminate\Http\JsonResponse;

class HabitCreateController extends Controller
{
    public function __construct(
        private readonly HabitServiceInterface $habitService,
    )
    {
    }

    public function __invoke(HabitCreateRequest $request): JsonResponse
    {
        $habit = $this->habitService->create(
            user: auth()->user(),
            data: $request->validated(),
        );

        $habit?->load(['habitType']);

        return $habit
            ? new SuccessResponse(
                data: ['data' => HabitResource::make($habit)],
                message: trans('habit.created', ['name' => $habit->name]),
            )
            : new FailResponse(message: trans('habit.not_created'));
    }
}
