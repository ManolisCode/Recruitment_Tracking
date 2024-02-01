<?php

namespace App\Rules;

use App\Models\Step;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class StepCategoryTimelineValidator implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {

        $steps = Step::where('timeline_id', request('timeline_id'))->get();

        foreach ($steps as $step) {
            if ($step['step_category_id'] == request('step_category_id')) {
                $fail('The step already exists.');
            }
            return;
        }
    }
}
