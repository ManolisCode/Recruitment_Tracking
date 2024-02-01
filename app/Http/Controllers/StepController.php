<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rules\CandidateTimelineValidator;
use App\Rules\StepCategoryTimelineValidator;
use Illuminate\Support\Facades\Validator;
use App\Models\Step;

class StepController extends Controller
{
    public function create(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'candidate_id' => 'required|exists:candidates,id',
            'timeline_id' => ['required', new CandidateTimelineValidator],
            'step_category_id' => ['required', 'exists:step_categories,id', new StepCategoryTimelineValidator],
            'status_category_id' => 'required|exists:step_status_categories,id',
            'recruiter_id' => 'required|exists:recruiters,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        Step::create([
            'candidate_id' => $request->candidate_id,
            'timeline_id' => $request->timeline_id,
            'step_category_id' => $request->step_category_id,
            'status_category_id' => $request->status_category_id,
            'recruiter_id' => $request->recruiter_id
        ]);
        return response()->json(['message' => 'Step created successfully'], 200);
    }
}
