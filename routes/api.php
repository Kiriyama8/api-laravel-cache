<?php

use App\Http\Controllers\Api\{
    CourseController
};
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json(['message' => 'Hello World!']);
});

Route::get('/courses', [CourseController::class, 'index']);
Route::post('/courses', [CourseController::class, 'store']);
