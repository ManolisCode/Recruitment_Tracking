<?php

namespace Tests\Feature;

use App\Http\Controllers\StepStatusController;
use App\Models\Candidate;
use App\Models\Recruiter;
use App\Models\Step;
use App\Models\Timeline;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;


class TimelineControllerTest extends TestCase
{

    use WithFaker;

    public function test_can_create_timeline_successfully()
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

    public function test_create_timeline_with_validation_errors()
    {
        $response = $this->postJson('/v1/timeline/create', []);

        $response->assertStatus(422);

        $response->assertJsonValidationErrors(['recruiter_id', 'candidate_name', 'candidate_surname']);
    }

    public function test_fetch_timeline()
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

        $response = $this->get("/v1/timeline/fetch/{$timeline->id}");
        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Timeline found successfully',
                'timeline' => [
                    'id' => $timeline->id,
                    'created_at' => $timeline->created_at->format('Y-m-d\TH:i:s.u\Z'),
                    'recruiter_name' => $recruiter->name,
                    'recruiter_surname' => $recruiter->surname,
                    'candidate_name' => $candidate->name,
                    'candidate_surname' => $candidate->surname,
                    'step_categories' => [
                        [
                            'category_name' => '1st Interview',
                            'status' => 'Pending'
                        ]
                    ]
                ],
            ]);
    }
}
