<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lecturer_educations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lecturer_id')->constrained()->cascadeOnDelete();
            $table->string('nidn')->nullable()->index();
            $table->string('degree_level')->nullable(); // S1, S2, S3
            $table->string('institution_name')->nullable();
            $table->string('study_program')->nullable();
            $table->unsignedSmallInteger('start_year')->nullable();
            $table->unsignedSmallInteger('graduation_year')->nullable();
            $table->string('academic_degree')->nullable();
            $table->string('degree_abbreviation')->nullable();
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->json('raw_data')->nullable();
            $table->timestamps();

            $table->index(['lecturer_id', 'degree_level']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lecturer_educations');
    }
};
