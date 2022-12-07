<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\InvokableRule;
use Illuminate\Support\Carbon;

class UsernameCanBeChangedInvokableRule implements InvokableRule
{
    /**
     * Run the validation rule.
     *
     * @param string $attribute
     * @param mixed $value
     * @param \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString $fail
     * @return void
     */
    public function __invoke($attribute, $value, $fail)
    {
        if ($value != auth()->user()->username) {
            if (auth()->user()->username_changed_at != null &&
                auth()->user()->username_changed_at->addDays(7) >= Carbon::now()) {
                $fail(__("Username can't be changed so often! Try in ") . auth()->user()->username_changed_at->addDays(7)->diffForHumans());
            }
        }
    }
}
