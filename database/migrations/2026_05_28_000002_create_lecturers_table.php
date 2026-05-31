<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lecturers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('study_program_id')->nullable()->constrained('study_programs')->nullOnDelete();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('nip')->nullable();
            $table->string('nidn')->nullable();
            $table->string('email')->nullable();
            $table->string('photo_url')->nullable();
            $table->string('academic_position')->nullable(); // Contoh: Lektor, Asisten Ahli, dsb.
            $table->text('bio')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lecturers');
    }
};
