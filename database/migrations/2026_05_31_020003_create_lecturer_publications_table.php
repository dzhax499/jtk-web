<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lecturer_publications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lecturer_id')->nullable()->constrained()->nullOnDelete();
            $table->string('source')->nullable()->index(); // scholar, scopus, pddikti, sinta
            $table->string('category')->nullable();
            $table->text('title');
            $table->text('matched_title')->nullable();
            $table->unsignedSmallInteger('year')->nullable()->index();
            $table->unsignedInteger('citation_count')->default(0);
            $table->string('venue')->nullable();
            $table->text('authors')->nullable();
            $table->string('publisher')->nullable();
            $table->longText('abstract')->nullable();
            $table->text('publication_url')->nullable();
            $table->text('eprint_url')->nullable();
            $table->string('doi')->nullable()->index();
            $table->string('eid')->nullable()->index();
            $table->string('sinta_id')->nullable()->index();
            $table->string('scopus_author_id')->nullable()->index();
            $table->string('status')->nullable();
            $table->json('raw_data')->nullable();
            $table->timestamps();

            $table->index(['lecturer_id', 'year']);
            $table->index(['lecturer_id', 'source']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lecturer_publications');
    }
};
