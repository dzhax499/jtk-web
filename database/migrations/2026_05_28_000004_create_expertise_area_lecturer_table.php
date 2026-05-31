<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('expertise_area_lecturer', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lecturer_id')->constrained('lecturers')->cascadeOnDelete();
            $table->foreignId('expertise_area_id')->constrained('expertise_areas')->cascadeOnDelete();
            $table->timestamps();

            $table->unique(['lecturer_id', 'expertise_area_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('expertise_area_lecturer');
    }
};
