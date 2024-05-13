<?php

namespace App\Http\Requests\Habit;

use App\Utils\Enums\HabitType\HabitTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class HabitUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->route('habit')->user_id === auth()->user()->id;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'exclude_if:name,null|max:255', 'unique:habits,name'],
            'description' => ['required', 'exclude_if:description,null|max:255'],
            'type' => ['required', 'string', Rule::in(HabitTypeEnum::getEnumValues())],
            'target' => ['required', 'numeric', 'min:21', 'exclude_if:target,null'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.unique' => 'Привычка с таким названием уже существует',
            'type.required' => 'Необходимо выбрать тип привычки.',
            'name.required' => 'Для создания привычки необходимо указать ее название.',
            'description.required' => 'Для создания привычки необходимо заполнить краткое описание.',
            'target.required' => 'Для создания привычки необходимо время за которое планируется ее выработать.',
            'name.max' => 'Поле \'Название привычки\' не должно превышать 255 символов.',
            'description.max' => 'Поле \'Описание\' не должно превышать 255 символов.',
            'target.min' => 'Минимальное количество дней для выработки привычки 21',
            'exists' => 'Такой привычки не существует',
        ];
    }
}
