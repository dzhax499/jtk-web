<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * List of tables to add extra_attributes column.
     */
    protected array $tables = [
        'users',
        'categories',
        'posts',
        'pages',
        'media',
        'study_programs',
        'expertise_areas',
        'lecturer_educations',
        'lecturer_links',
        'lecturer_portfolio_items',
        'lecturer_publications',
        'lecturer_teaching_histories'
    ];

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        foreach ($this->tables as $tableName) {
            if (Schema::hasTable($tableName) && !Schema::hasColumn($tableName, 'extra_attributes')) {
                Schema::table($tableName, function (Blueprint $table) {
                    $table->json('extra_attributes')->nullable();
                });
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        foreach ($this->tables as $tableName) {
            if (Schema::hasTable($tableName) && Schema::hasColumn($tableName, 'extra_attributes')) {
                Schema::table($tableName, function (Blueprint $table) {
                    $table->dropColumn('extra_attributes');
                });
            }
        }
    }
};
