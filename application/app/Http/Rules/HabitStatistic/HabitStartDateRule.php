<?php

namespace App\Http\Rules\HabitStatistic;

use App\Models\Habit;
use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class HabitStartDateRule implements ValidationRule
{

    private string $habidId;

    public function __construct(string $habidId)
    {
        $this->habidId = $habidId;
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $carbonValue = Carbon::createFromFormat('Y-m-d', $value)
            ->startOfDay();

        $habit = Habit::query()
            ->find($this->habidId);

        if ($habit->created_at->startOfDay() > $carbonValue) {
            $fail(trans('statistic.incorrect-start-date'));
        }
    }
}
