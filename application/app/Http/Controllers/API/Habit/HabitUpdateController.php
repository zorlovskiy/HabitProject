<?php

namespace App\Http\Controllers\API\Habit;

use App\Http\Controllers\Controller;
use App\Http\Requests\Habit\HabitUpdateRequest;
use App\Http\Resources\Habit\HabitResource;
use App\Http\Responses\FailResponse;
use App\Http\Responses\SuccessResponse;
use App\Models\Habit;
use App\Services\Habit\HabitServiceInterface;
use Illuminate\Http\JsonResponse;

class HabitUpdateController extends Controller
{
    public function __construct(
        private readonly HabitServiceInterface $habitService
    )
    {
    }

    public function __invoke(HabitUpdateRequest $request, Habit $habit): JsonResponse
    {
        $habit = $this->habitService->update(
            habit: $habit,
            data: $request->validated()
        );

        return $habit
            ? new SuccessResponse(
                data: ['data' => HabitResource::make($habit)],
                message: trans('habit.updated', ['name' => $habit->name]),
            )
            : new FailResponse(message: trans('habit.not_updated'));

    }
}
