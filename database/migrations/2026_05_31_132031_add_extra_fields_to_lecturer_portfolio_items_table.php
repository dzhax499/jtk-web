<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('lecturer_portfolio_items', function (Blueprint $table) {
            if (!Schema::hasColumn('lecturer_portfolio_items', 'category')) {
                $table->string('category')->nullable();
            }

            if (!Schema::hasColumn('lecturer_portfolio_items', 'raw_data')) {
                $table->json('raw_data')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('lecturer_portfolio_items', function (Blueprint $table) {
            if (Schema::hasColumn('lecturer_portfolio_items', 'category')) {
                $table->dropColumn('category');
            }

            if (Schema::hasColumn('lecturer_portfolio_items', 'raw_data')) {
                $table->dropColumn('raw_data');
            }
        });
    }
};