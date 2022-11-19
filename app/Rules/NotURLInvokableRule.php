<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\InvokableRule;

class NotURLInvokableRule implements InvokableRule
{
    /**
     * Run the validation rule.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     * @return void
     */
    public function __invoke($attribute, $value, $fail)
    {
        if (preg_match('/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/', $value)) {
            $fail('The :attribute must not be a URL.');
        }
    }
}
