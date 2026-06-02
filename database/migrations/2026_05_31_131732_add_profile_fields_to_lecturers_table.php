<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('lecturers', function (Blueprint $table) {
            if (!Schema::hasColumn('lecturers', 'gender')) {
                $table->string('gender')->nullable();
            }

            if (!Schema::hasColumn('lecturers', 'employment_status')) {
                $table->string('employment_status')->nullable();
            }

            if (!Schema::hasColumn('lecturers', 'activity_status')) {
                $table->string('activity_status')->nullable();
            }

            if (!Schema::hasColumn('lecturers', 'highest_education')) {
                $table->string('highest_education')->nullable();
            }

            if (!Schema::hasColumn('lecturers', 'raw_data')) {
                $table->json('raw_data')->nullable();
            }
        });
    }

    public function down(): void
    {
        $columns = [
            'gender',
            'employment_status',
            'activity_status',
            'highest_education',
            'raw_data',
        ];

        $existingColumns = array_filter($columns, function ($column) {
            return Schema::hasColumn('lecturers', $column);
        });

        if (!empty($existingColumns)) {
            Schema::table('lecturers', function (Blueprint $table) use ($existingColumns) {
                $table->dropColumn($existingColumns);
            });
        }
    }
};