<?php

namespace App\Http\Controllers\API\Habit;

use App\Http\Controllers\Controller;
use App\Http\Requests\Habit\HabitStatisticRequest;
use App\Http\Responses\FailResponse;
use App\Http\Responses\SuccessResponse;
use App\Models\Habit;
use App\Services\Habit\HabitServiceInterface;
use Illuminate\Http\JsonResponse;

class HabitStatisticController extends Controller
{
    public function __construct(
        private readonly HabitServiceInterface $habitService,
    )
    {
    }

    public function __invoke(HabitStatisticRequest $request, Habit $habit): JsonResponse
    {
        $result = $this->habitService->statisticByPeriod(
            habit: $habit,
            data: $request->validated()
        );

        return $result
            ? new SuccessResponse(
                data: ['data' => $result],
                message: trans('habit.statistic',
                    [
                    'result' => $result['result'],
                    'active' => $result['active'],
                    'marksBetweenDates' => $result['marksBetweenDates']
                ]),
            )
            : new FailResponse(message: trans('habit.failed_statistic'));

    }
}
