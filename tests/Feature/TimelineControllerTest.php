<?php

namespace Tests\Feature;

use App\Models\Candidate;
use App\Models\Recruiter;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TimelineControllerTest extends TestCase
{

    use WithFaker;

    public function test_create_timeline_successfully()
    {

        $recruiter = Recruiter::factory()->create();

        $candidateData = [
            'candidate_name' => $this->faker->firstName,
            'candidate_surname' => $this->faker->lastName,
        ];

        $response = $this->postJson('/v1/timeline/create', [
            'recruiter_id' => $recruiter->id,
            'candidate_name' => $candidateData['candidate_name'],
            'candidate_surname' => $candidateData['candidate_surname'],
        ]);

        $response->assertStatus(200);
    }
}
