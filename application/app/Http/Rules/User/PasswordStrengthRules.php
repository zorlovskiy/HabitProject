<?php

namespace App\Http\Rules\User;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class PasswordStrengthRules implements ValidationRule
{

    /**
     * @inheritDoc
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $result = preg_match(
            '/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!?@#$%^&])[0-9a-zA-Z!?@#$%^&]{8,128}$/',
            $value
        );

        if (!$result) {
            $fail(trans('rules.incorrect-password'));
        }
    }
}
