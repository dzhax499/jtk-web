<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lecturer_links', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lecturer_id')->constrained('lecturers')->cascadeOnDelete();
            $table->string('platform'); // pddikti, sinta, google_scholar, scopus, garuda, personal_website
            $table->string('url');
            $table->timestamps();

            $table->index(['lecturer_id', 'platform']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lecturer_links');
    }
};
