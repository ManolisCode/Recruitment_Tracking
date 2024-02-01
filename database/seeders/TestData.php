<?php

namespace Database\Seeders;

use App\Models\Candidate;
use App\Models\Recruiter;
use App\Models\Step;
use App\Models\StepCategory;
use App\Models\StepStatus;
use App\Models\StepStatusCategory;
use App\Models\Timeline;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class TestData extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Recruiter::create([
            'name' => 'Aggeliki',
            'surname' => 'Kapetanidou',
        ]);

        Candidate::create([
            'name' => 'John',
            'surname' => 'Doe',
        ]);

        Timeline::create([
            'recruiter_id' => 1,
            'candidate_id' => 1
        ]);
    }
}
