<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lecturer_teaching_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lecturer_id')->constrained()->cascadeOnDelete();
            $table->foreignId('study_program_id')->nullable()->constrained()->nullOnDelete();
            $table->string('nidn')->nullable()->index();
            $table->string('semester_name')->nullable();
            $table->string('course_code')->nullable();
            $table->string('course_name');
            $table->string('class_name')->nullable();
            $table->string('academic_year')->nullable();
            $table->boolean('is_active')->default(true);
            $table->json('raw_data')->nullable();
            $table->timestamps();

            $table->index(['lecturer_id', 'course_name']);
            $table->index(['course_code', 'class_name']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lecturer_teaching_histories');
    }
};
