<?php

namespace App\Http\Rules\HabitStatistic;

use App\Models\Habit;
use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class HabitEndDateRule implements ValidationRule
{

    private string $userId;

    public function __construct(string $userId)
    {
        $this->userId = $userId;
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $carbonValue = Carbon::createFromFormat('Y-m-d', $value)
            ->startOfDay();
        $habit = Habit::query()
            ->find($this->userId);

        $endDate = $this->endDate(habit: $habit);

        if ($endDate < $carbonValue) {
            $fail(trans('statistic.incorrect-end-date'));
        }
    }

    public function endDate(Habit $habit): Carbon
    {
        /** @var Carbon $endDate */
        $target = $habit->target;

        $endDate = $habit->created_at->startOfDay()->addDays($target);

        return $endDate;
    }
}
