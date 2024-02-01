<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StepStatus;
use Illuminate\Support\Facades\Validator;
use App\Rules\CandidateTimelineValidator;
use App\Rules\StepTimelineValidator;
use App\Models\StepStatusCategory;



class StepStatusController extends Controller
{
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'candidate_id' => 'required|exists:candidates,id',
            'timeline_id' => ['required', new CandidateTimelineValidator],
            'step_id' => ['required', new StepTimelineValidator],
            'status_category_id' => 'required|exists:step_status_categories,id',
            'recruiter_id' => 'required|exists:recruiters,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        StepStatus::create([
            'candidate_id' => $request->candidate_id,
            'timeline_id' => $request->timeline_id,
            'step_id' => $request->step_id,
            'status_category_id' => $request->status_category_id,
            'recruiter_id' => $request->recruiter_id
        ]);
        return response()->json(['message' => 'Step Status created successfully'], 200);
    }

    public static function getLatestStatus($stepId)
    {

        $latestStepStatus = StepStatus::where('step_id', $stepId)
            ->latest('created_on')
            ->value('status_category_id');
        return StepStatusCategory::where('id',  $latestStepStatus)->value('name');
    }
}
