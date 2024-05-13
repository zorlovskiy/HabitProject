<?php

namespace App\Http\Requests\ProgressMark;

use App\Http\Rules\Habit\HabitRules;
use App\Models\Habit;
use App\Utils\Enums\ProgressMark\ProgressMarkEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProgressMarkCreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $userId = auth()->user()->id;

        return [
            'habit_id' => ['required', 'string', 'exists:' . (new Habit())->getTable() . ',id', (new HabitRules($userId))],
            'mark' => ['string', 'exclude_if:target,null', Rule::in(ProgressMarkEnum::getEnumValues())],
        ];
    }

    public function messages(): array
    {
        return [
            'habit_id.required' => "Не выбрана привычка для которой хотите сделать отметку",
        ];
    }
}

