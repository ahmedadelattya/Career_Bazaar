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
        Schema::table('applications', function (Blueprint $table) {
            $table->string('name')->after('candidate_id');
            $table->string('email')->after('name');
            $table->string('phone')->after('email');
            $table->string('resume')->after('phone');
            $table->unique(['job_id', 'candidate_id'], 'unique_job_application');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('applications', function (Blueprint $table) {
            $table->dropColumn(['name', 'email', 'phone', 'resume']);
            $table->dropUnique('unique_job_application');
        });
    }
};
