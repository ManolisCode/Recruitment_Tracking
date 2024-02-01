<?php

namespace Tests\Unit;

use App\Models\Timeline;
use App\Models\Recruiter;
use App\Models\Candidate;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;


class TimelineModelTest extends TestCase
{
    use WithFaker;

    function test_can_create_timeline_model_instance()
    {

        $recruiter = Recruiter::factory()->create();
        $candidate = Candidate::factory()->create();

        $data = [
            'recruiter_id' =>  $recruiter->id,
            'candidate_id' => $candidate->id,
        ];

        $model = Timeline::create($data);

        $this->assertInstanceOf(Timeline::class, $model);
        $this->assertDatabaseHas('timelines', $data);
    }
}
