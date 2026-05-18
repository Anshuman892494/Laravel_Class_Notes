<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class checkUpperCase implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if ($value !== strtoupper($value)) {

            $fail('The must be in UPPERCASE.');
        }
    }
}