<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('study_programs', function (Blueprint $table) {
            $table->text('about')->nullable();
            $table->text('lecturer_qualification')->nullable();
            $table->json('facilities')->nullable();
            $table->text('career_prospects')->nullable();
            $table->json('career_prospects_list')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('study_programs', function (Blueprint $table) {
            $table->dropColumn([
                'about',
                'lecturer_qualification',
                'facilities',
                'career_prospects',
                'career_prospects_list',
            ]);
        });
    }
};
