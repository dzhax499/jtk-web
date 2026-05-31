<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lecturer_portfolio_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lecturer_id')->constrained('lecturers')->cascadeOnDelete();
            $table->string('type'); // research, publication, community_service, teaching, award, certification, project
            $table->text('title');
            $table->text('description')->nullable();
            $table->year('year')->nullable();
            $table->string('source')->nullable(); // Contoh: PDDIKTI, SINTA, internal JTK, manual admin
            $table->string('external_url')->nullable();
            $table->timestamps();

            $table->index(['lecturer_id', 'type', 'year']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lecturer_portfolio_items');
    }
};
