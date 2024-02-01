<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RecruiterControllerTest extends TestCase
{

    use WithFaker;

    public function testRecruiterCreationWithValidationErrors()
    {
        $response = $this->postJson('/v1/recruiter/create', []);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['name', 'surname']);
    }

    public function testRecruiterCreationSuccess()
    {
        $data = [
            'name' => $this->faker->firstName,
            'surname' => $this->faker->lastName,
        ];

        $response = $this->postJson('/v1/recruiter/create', $data);

        $response->assertStatus(200)
            ->assertJson(['message' => 'Recruiter created successfully']);
    }
}
