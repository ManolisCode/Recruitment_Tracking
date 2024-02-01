<?php

namespace Tests\Unit;

use App\Models\Candidate;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;


class CandidateModelTest extends TestCase
{
    use WithFaker;

    function test_can_create_candidate_model_instance()
    {
        $data = [
            'name' => $this->faker->firstName,
            'surname' => $this->faker->lastName,
        ];

        $model = Candidate::create($data);

        $this->assertInstanceOf(Candidate::class, $model);
        $this->assertDatabaseHas('candidates', $data);
    }
}
