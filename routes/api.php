<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\ValidateLimitStudentsToUser;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {

    Route::get('dashboard', [DashboardController::class, 'index']);

    Route::get('exercises', [ExerciseController::class, 'index']);
    Route::post('exercises', [ExerciseController::class, 'store']);
    Route::delete('exercises/{id}', [ExerciseController::class, 'destroy']);

    Route::get('students', [StudentController::class, 'index']);
    Route::post('students', [StudentController::class, 'store'])->middleware(ValidateLimitStudentsToUser::class);
    Route::delete('students/{id}', [StudentController::class, 'destroy']);

});

Route::post('login', [AuthController::class, 'store']);
Route::post('users', [UserController::class, 'store']);
