<?php

namespace Database\Factories;

use App\Models\Step;
use Illuminate\Database\Eloquent\Factories\Factory;

class StepFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Step::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(array $attributes = []): array
    {
        $candidateId = $attributes['candidate_id'] ?? null;
        $timelineId = $attributes['timeline_id'] ?? null;
        $recruiterId = $attributes['recruiter_id'] ?? null;
        $step_category_id = $attributes['step_category_id'] ?? null;
        $status_category_id = $attributes['status_category_id'] ?? null;

        return [
            'candidate_id' => $candidateId ?? $this->faker->randomNumber(),
            'timeline_id' => $timelineId ?? $this->faker->randomNumber(),
            'step_category_id' => $step_category_id ?? $this->faker->randomNumber(),
            'status_category_id' => $status_category_id ?? $this->faker->randomNumber(),
            'recruiter_id' => $recruiterId ?? $this->faker->randomNumber(),
        ];
    }
}
