<?php

namespace App\Http\Requests\Habit;

use App\Http\Rules\HabitStatistic\HabitEndDateRule;
use App\Http\Rules\HabitStatistic\HabitStartDateRule;
use Illuminate\Foundation\Http\FormRequest;

class HabitStatisticRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->route('habit')->user_id === auth()->user()->id;
    }

    public function rules(): array
    {
        return [
            'start_date' => ['required', 'date_format:Y-m-d', (new HabitStartDateRule($this->route('habit')->id))],
            'end_date' => ['required', 'date_format:Y-m-d', 'after:start_date', (new HabitEndDateRule($this->route('habit')->id))]
        ];
    }

    public function messages(): array
    {
        return [
            'start_date.required' => 'Укажите начальную дату периода',
            'end_date.required' => 'Укажите конечную дату периода',
        ];
    }
}
