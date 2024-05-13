<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'username' => ['required', 'exclude_if:username,null|max:255'],
            'email' => ['required', 'email:rfc', 'exclude_if:email,null', 'unique:users,email'],
            'password' => ['required',],
            'firstname' => ['required', 'string', 'exclude_if:firstname,null|max:255'],
            'lastname' => ['required', 'string', 'exclude_if:lastname,null|max:255']
        ];
    }

    protected function prepareForValidation(): void
    {
        if ($this->has('email')) {
            $this->merge(
                ['email' => strtolower($this->email)]
            );
        }
    }

    public function messages(): array
    {
        return [
            'password.required' => 'Для создания пользователя необходимо создать пароль.',
            'email.required' => 'Для создания пользователя необходимо указать почту.',
            'email.unique' => 'Пользователь с такой почтой уже существует',
            'firstname.required' => 'Для создания пользователя необходимо указать имя.',
            'lastname.required' => 'Для создания пользователя необходимо указать фамилию.',
            'username.max' => 'Поле \'Имя Пользователя\' не должно превышать 255 символов.',
            'firstname.max' => 'Поле \'Имя\' не должно превышать 255 символов.',
            'lastname.max' => 'Поле \'Фамилия\' не должно превышать 255 символов.',
        ];
    }


}
