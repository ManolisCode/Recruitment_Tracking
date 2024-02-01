<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Models\Candidate;
use App\Models\Timeline;

class CandidateTimelineValidator implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $timeline = Timeline::find($value);

        if (!$timeline) {
            $fail('The timeline does not exist.');
            return;
        }

        if ($timeline->candidate_id != request('candidate_id')) {
            $fail('The candidate_id and timeline_id do not match.');
        }
    }
}
