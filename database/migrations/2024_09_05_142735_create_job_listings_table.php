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
        Schema::create('job_listings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employer_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('title');
            $table->text('description');
            $table->string('category');
            $table->string('location');
            $table->enum('salary_type', ['fixed', 'hourly']);
            $table->decimal('fixed_salary', 10, 2)->nullable();
            $table->decimal('hourly_rate', 10, 2)->nullable();
            $table->json('skills')->nullable();
            $table->enum('status', ['pending', 'approved', 'declined'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_listings');
    }
};
