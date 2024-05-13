<?php

namespace App\Http\Controllers\API\Habit;

use App\Http\Controllers\Controller;
use App\Http\Requests\Habit\HabitDeleteRequest;
use App\Http\Responses\FailResponse;
use App\Http\Responses\SuccessResponse;
use App\Services\Habit\HabitServiceInterface;

class HabitDeleteController extends Controller
{
    public function __construct(
        private readonly HabitServiceInterface $habitService
    )
    {
    }

    public function __invoke(HabitDeleteRequest $request)
    {
        $habitIds = $request->validated('habits');

        return $this->habitService->delete($habitIds)
            ? new SuccessResponse(
                message: trans('habit.deleted', ['id' => implode(",", $habitIds)])
            )
            : new FailResponse(
                message: trans( 'habit.not_deleted', ['id' => implode(",", $habitIds)])
            );
    }
}
