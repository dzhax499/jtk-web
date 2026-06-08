<?php

use App\Http\Controllers\Api\CategoryApiController;
use App\Http\Controllers\Api\LecturerApiController;
use App\Http\Controllers\Api\MediaApiController;
use App\Http\Controllers\Api\PageApiController;
use App\Http\Controllers\Api\PostApiController;
use App\Http\Controllers\Api\StudyProgramApiController;
use Illuminate\Support\Facades\Route;

Route::get('/health', fn () => response()->json([
    'status' => 'ok',
    'service' => 'JTK Web API',
]));

// Pendukung halaman berita/prestasi dan konten CMS
Route::middleware('throttle:api')->group(function () {
    Route::get('/categories', [CategoryApiController::class, 'index']);
    Route::get('/media', [MediaApiController::class, 'index']);

    // Akademik, Akreditasi, Visi Misi, dan halaman CMS lain
    Route::get('/pages', [PageApiController::class, 'index']);
    Route::get('/pages/{slug}', [PageApiController::class, 'show']);

    // Berita dan Prestasi
    Route::get('/posts', [PostApiController::class, 'index']);
    Route::get('/posts/{slug}', [PostApiController::class, 'show']);

    // Data program studi
    Route::get('/study-programs', [StudyProgramApiController::class, 'index']);
    Route::get('/study-programs/{slug}', [StudyProgramApiController::class, 'show']);

    // Data dosen
    Route::get('/lecturers', [LecturerApiController::class, 'index']);
    Route::get('/lecturers/{slug}', [LecturerApiController::class, 'show']);
    Route::get('/lecturers/{slug}/portfolio', [LecturerApiController::class, 'portfolio']);
});
