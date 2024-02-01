<?php

namespace Tests\Unit;

use App\Models\Candidate;
use App\Models\Step;
use App\Models\Recruiter;
use App\Models\Timeline;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;


class StepModelTest extends TestCase
{
    use WithFaker;

    function test_can_create_step_model_instance()
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

        $model = Step::create($step_data);

        $this->assertInstanceOf(Step::class, $model);
        $this->assertDatabaseHas('steps', $step_data);
    }
}
