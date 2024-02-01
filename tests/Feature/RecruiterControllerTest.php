<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RecruiterControllerTest extends TestCase
{

    use WithFaker;

    public function test_can_create_recruiter_successfully()
    {
        $data = [
            'name' => $this->faker->firstName,
            'surname' => $this->faker->lastName,
        ];

        $response = $this->postJson('/v1/recruiter/create', $data);

        $response->assertStatus(200)
            ->assertJson(['message' => 'Recruiter created successfully']);
    }

    public function test_create_recruiter_with_validation_errors()
    {
        $response = $this->postJson('/v1/recruiter/create', []);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['name', 'surname']);
    }
}
