<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigInteger('id')->primary();
            $table->text('title')->nullable();
            $table->string('slug')->nullable();
            $table->longText('content')->nullable();
            $table->text('excerpt')->nullable();
            $table->string('status')->default('publish');
            $table->bigInteger('author_id')->nullable();
            $table->bigInteger('featured_media_id')->nullable();
            $table->dateTime('published_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};