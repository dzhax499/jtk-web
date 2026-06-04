<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('study_programs', function (Blueprint $table) {
            $table->json('objectives')->nullable();
            $table->json('graduate_profiles')->nullable();
            $table->json('job_positions')->nullable();
            $table->text('accreditation_text')->nullable();
            $table->string('accreditation_certificate_url')->nullable();
            $table->string('accreditation_website_url')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('study_programs', function (Blueprint $table) {
            $table->dropColumn([
                'objectives',
                'graduate_profiles',
                'job_positions',
                'accreditation_text',
                'accreditation_certificate_url',
                'accreditation_website_url',
            ]);
        });
    }
};
