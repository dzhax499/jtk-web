<?php

use App\Http\Controllers\Api\CategoryApiController;
use App\Http\Controllers\Api\LecturerApiController;
use App\Http\Controllers\Api\MediaApiController;
use App\Http\Controllers\Api\PageApiController;
use App\Http\Controllers\Api\StudyProgramApiController;
use Illuminate\Support\Facades\Route;

Route::get('/health', fn () => response()->json([
    'status' => 'ok',
    'service' => 'JTK Web API',
]));

Route::get('/categories', [CategoryApiController::class, 'index']);
Route::get('/media', [MediaApiController::class, 'index']);

Route::get('/pages', [PageApiController::class, 'index']);
Route::get('/pages/{slug}', [PageApiController::class, 'show']);

Route::get('/study-programs', [StudyProgramApiController::class, 'index']);
Route::get('/study-programs/{slug}', [StudyProgramApiController::class, 'show']);

Route::get('/lecturers', [LecturerApiController::class, 'index']);
Route::get('/lecturers/{slug}', [LecturerApiController::class, 'show']);
Route::get('/lecturers/{slug}/portfolio', [LecturerApiController::class, 'portfolio']);
