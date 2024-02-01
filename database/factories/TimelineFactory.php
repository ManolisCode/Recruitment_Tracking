<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Timeline>
 */
class TimelineFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(array $attributes = []): array
    {
        $recruiterId = $attributes['recruiter_id'] ?? null;
        $candidateId = $attributes['candidate_id'] ?? null;

        return [
            'recruiter_id' => $recruiterId ?? $this->faker->randomNumber(),
            'candidate_id' => $candidateId ?? $this->faker->randomNumber(),
        ];
    }
}
