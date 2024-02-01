<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Models\Step;

class StepTimelineValidator implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $step = Step::find($value);

        if (!$step) {
            $fail('The step does not exist.');
            return;
        }

        if ($step->timeline_id != request('timeline_id')) {
            $fail('The step_id and timeline_id do not match.');
        }
    }
}
