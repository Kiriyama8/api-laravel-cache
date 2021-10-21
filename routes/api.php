<?php

use App\Http\Controllers\Api\{
    CourseController,
    LessonController,
    ModuleController
};
use Illuminate\Support\Facades\Route;

Route::get('/courses', [CourseController::class, 'index']);
Route::post('/courses', [CourseController::class, 'store']);
Route::get('/courses/{id}', [CourseController::class, 'show']);
Route::delete('/courses/{id}', [CourseController::class, 'destroy']);
Route::put('/courses/{course}', [CourseController::class, 'update']);

Route::apiResource('/courses/{course}/modules', ModuleController::class);
Route::apiResource('/modules/{module}/lessons', LessonController::class);
