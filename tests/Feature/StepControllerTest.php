<?php

namespace Tests\Feature;

use App\Models\Candidate;
use App\Models\Recruiter;
use App\Models\Timeline;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;


class StepControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_create_step_successfully()
    {
        $recruiter = Recruiter::factory()->create();
        $candidate = Candidate::factory()->create();
        $timeline = Timeline::factory()->create(['candidate_id' => $candidate->id, 'recruiter_id' => $recruiter->id]);

        // Valid data for the request
        $data = [
            'candidate_id' => $candidate->id,
            'timeline_id' => $timeline->id,
            'step_category_id' => 1,
            'status_category_id' => 1,
            'recruiter_id' => $recruiter->id,
        ];

        // Send a request to the create endpoint
        $response = $this->postJson('/v1/step/create', $data);

        // Assert the response is successful
        $response->assertStatus(200);

        // Assert that a step was created in the database
        $this->assertDatabaseHas('steps', $data);
    }
}
