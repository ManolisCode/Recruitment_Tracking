<?php

namespace Tests\Feature;

use App\Models\Candidate;
use App\Models\Recruiter;
use App\Models\Timeline;
use App\Models\Step;
use Tests\TestCase;


class StepStatusControllerTest extends TestCase
{

    public function test_can_create_step_status_successfully()
    {
        $recruiter = Recruiter::factory()->create();
        $candidate = Candidate::factory()->create();
        $timeline = Timeline::factory()->create(['candidate_id' => $candidate->id, 'recruiter_id' => $recruiter->id]);
        $step = Step::factory()->create([
            'candidate_id' => $candidate->id,
            'recruiter_id' => $recruiter->id,
            'timeline_id' => $timeline->id,
            'step_category_id' => 1,
            'status_category_id' => 1
        ]);

        $data = [
            'candidate_id' => $candidate->id,
            'timeline_id' => $timeline->id,
            'step_id' => $step->id,
            'status_category_id' => 2,
            'recruiter_id' => $recruiter->id,
        ];

        $response = $this->postJson('/v1/step_status/create', $data);
        $response->assertStatus(200);
        $this->assertDatabaseHas('steps', $data);
    }

    public function test_create_step_with_validation_errors()
    {
        $response = $this->postJson('/v1/step_status/create', []);

        $response->assertStatus(422);

        $response->assertJsonValidationErrors(['candidate_id', 'timeline_id', 'step_id', 'status_category_id', 'recruiter_id']);
    }

    public function test_create_step_with_candidate_timeline_missmatch()
    {
        $response = $this->postJson('/v1/step_status/create', [
            'candidate_id' => 1,
            'timeline_id' => 5,
            'step_id' => 1,
            'status_category_id' => 1,
            'recruiter_id' => 1
        ]);

        $response->assertStatus(422);

        $response->assertJsonValidationErrors(['timeline_id']);
    }

    public function test_create_step_with_step_timeline_missmatch()
    {
        $response = $this->postJson('/v1/step/create', [
            'candidate_id' => 1,
            'timeline_id' => 1,
            'step_id' => 5,
            'status_category_id' => 1,
            'recruiter_id' => 1
        ]);

        $response->assertStatus(422);

        $response->assertJsonValidationErrors(['step_id']);
    }
}
