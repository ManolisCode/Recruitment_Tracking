<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\CandidateController;
use App\Models\Timeline;
use App\Models\Step;
use App\Models\StepCategory;
use App\Models\StepStatusCategory;
use App\Http\Controllers\StepStatusController;
use App\Models\Recruiter;
use App\Models\Candidate;
use Illuminate\Support\Facades\Validator;

class TimelineController extends Controller
{
    public function create(Request $request)
    {
        // Define validation rules
        $validator = Validator::make($request->all(), [
            'recruiter_id' => 'required|exists:recruiters,id',
            'candidate_name' => 'required|string|max:255',
            'candidate_surname' => 'required|string|max:255',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $candidate = new CandidateController();
        $candidateId = $candidate->create($request->candidate_name, $request->candidate_surname);
        Timeline::create([
            'recruiter_id' => $request->recruiter_id,
            'candidate_id' => $candidateId
        ]);
        return response()->json(['message' => 'Timeline created successfully'], 200);
    }

    public function fetch(Request $request)
    {

        $timeline = Timeline::find($request->timeline_id);
        $recruiter =  Recruiter::find($timeline['recruiter_id']);
        $candidate = Candidate::find($timeline['candidate_id']);
        $timeline['recruiter_name'] = $recruiter['name'];
        $timeline['recruiter_surname'] = $recruiter['surname'];
        $timeline['candidate_name'] = $candidate['name'];
        $timeline['candidate_surname'] = $candidate['surname'];
        $steps = Step::where('timeline_id', $request->timeline_id)->get();
        $stepCategories = [];
        foreach ($steps as $step) {

            $step['category_name'] = StepCategory::where('id', $step['step_category_id'])->value('name');
            $stepCategory = [
                'category_name' => $step['category_name'],
                'status' => StepStatusController::getLatestStatus($step['id'])
            ];
            $stepCategories[] = $stepCategory;
        }
        $timeline->setAttribute('step_categories', $stepCategories);
        return response()->json(['message' => 'Timeline found successfully', 'timeline' => $timeline], 200);
    }
}
