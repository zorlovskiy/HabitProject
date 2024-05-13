<?php

namespace App\Http\Requests\Habit;

use App\Http\Rules\Habit\HabitRules;
use App\Models\Habit;
use Illuminate\Foundation\Http\FormRequest;

class HabitDeleteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $userId = auth()->user()->id;

        return [
            'habits' => ['required', 'array', 'min:1'],
            'habits.*' => ['string', 'exists:' . (new Habit())->getTable() . ',id', (new HabitRules($userId))],
        ];
    }

    public function messages(): array
    {
        return [
            'exists' => 'Такой привычки не существует',
        ];
    }
}
