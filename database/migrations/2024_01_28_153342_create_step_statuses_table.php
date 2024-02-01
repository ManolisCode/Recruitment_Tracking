<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('step_statuses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('candidate_id');
            $table->unsignedBigInteger('timeline_id');
            $table->unsignedBigInteger('step_id');
            $table->unsignedBigInteger('status_category_id');
            $table->unsignedBigInteger('recruiter_id');
            $table->timestamps();

            $table->foreign('candidate_id')->references('id')->on('candidates');
            $table->foreign('timeline_id')->references('id')->on('timelines');
            $table->foreign('step_id')->references('id')->on('steps');
            $table->foreign('status_category_id')->references('id')->on('step_status_categories');
            $table->foreign('recruiter_id')->references('id')->on('recruiters');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('step_statuses');
    }
};
