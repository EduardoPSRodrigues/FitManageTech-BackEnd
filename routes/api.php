<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WorkoutController;
use App\Http\Controllers\WorkoutReportController;
use App\Http\Middleware\ValidateLimitStudentsToUser;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {

    Route::get('dashboard', [DashboardController::class, 'index']);

    Route::get('exercises', [ExerciseController::class, 'index']);
    Route::post('exercises', [ExerciseController::class, 'store']);
    Route::delete('exercises/{id}', [ExerciseController::class, 'destroy']);

    Route::get('students', [StudentController::class, 'index']);
    Route::post('students', [StudentController::class, 'store'])->middleware(ValidateLimitStudentsToUser::class);
    Route::put('students/{id}', [StudentController::class, 'update']);
    Route::delete('students/{id}', [StudentController::class, 'destroy']);

    Route::post('workouts', [WorkoutController::class, 'store']);
    Route::get('students/workouts', [WorkoutController::class, 'index']);

    Route::get('students/export', [WorkoutReportController::class, 'exportWorkoutPDF']);

    Route::get('students/{id}', [StudentController::class, 'show']);

});

Route::post('login', [AuthController::class, 'store']);
Route::post('users', [UserController::class, 'store']);
