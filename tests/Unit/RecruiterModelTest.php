<?php

namespace Tests\Unit;

use App\Models\Recruiter;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;


class RecruiterModelTest extends TestCase
{
    use WithFaker;

    function test_can_create_recruiter_model_instance()
    {
        $data = [
            'name' => $this->faker->firstName,
            'surname' => $this->faker->lastName,
        ];

        $model = Recruiter::create($data);

        $this->assertInstanceOf(Recruiter::class, $model);
        $this->assertDatabaseHas('recruiters', $data);
    }
}
