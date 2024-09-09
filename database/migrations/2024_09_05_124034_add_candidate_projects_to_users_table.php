<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->json('candidate_projects')->nullable();
            $table->json('candidate_skills')->nullable();
            $table->string('candidate_job_title')->nullable();
            $table->text('candidate_job_description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['candidate_projects', 'candidate_skills', 'candidate_job_title', 'candidate_job_description']);
        });
    }
};
