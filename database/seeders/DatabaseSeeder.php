<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\StepCategory;
use App\Models\StepStatusCategory;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        StepCategory::insert([
            ['name' => '1st Interview'],
            ['name' => 'Tech Assesment'],
            ['name' => 'Offer'],
        ]);

        StepStatusCategory::insert([
            ['name' => 'Pending'],
            ['name' => 'Completed'],
            ['name' => 'Rejected'],
        ]);
    }
}
