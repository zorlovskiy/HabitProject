<?php

namespace App\Http\Rules\Habit;

use App\Models\Habit;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class HabitRules implements ValidationRule
{
    private string $userId;

    public function __construct(string $userId)
    {
        $this->userId = $userId;
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $ifExist = Habit::query()
            ->where('user_id', $this->userId)
            ->first();

        if (!$ifExist) {
            $fail(trans('habit.incorrect_habit_id'));
        }
    }
}
