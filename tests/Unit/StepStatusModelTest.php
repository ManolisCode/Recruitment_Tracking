<?php

namespace Tests\Unit;

use App\Models\Candidate;
use App\Models\Step;
use App\Models\Recruiter;
use App\Models\StepStatus;
use App\Models\Timeline;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;


class StepStatusModelTest extends TestCase
{
    use WithFaker;

    function test_can_create_step_status_model_instance()
    {
        $recruiter = Recruiter::factory()->create();
        $candidate = Candidate::factory()->create();

        $timeline_data = [
            'recruiter_id' => $recruiter->id,
            'candidate_id' => $candidate->id,
        ];

        $timeline = Timeline::factory($timeline_data)->create();
        $step_data = [
            'candidate_id' => $candidate->id,
            'timeline_id' => $timeline->id,
            'step_category_id' => 1,
            'status_category_id' => 1,
            'recruiter_id' => $recruiter->id,
        ];

        $step = Step::create($step_data);

        $step_status_data = [
            'candidate_id' => $candidate->id,
            'timeline_id' => $timeline->id,
            'step_id' => $step->id,
            'status_category_id' => 1,
            'recruiter_id' => $recruiter->id,
        ];

        $model = StepStatus::create($step_status_data);

        $this->assertInstanceOf(StepStatus::class, $model);
        $this->assertDatabaseHas('step_statuses', $step_status_data);
    }
}
