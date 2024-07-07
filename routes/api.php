<?php

use App\Http\Controllers\Api\V1\TrainingController;
use App\Http\Controllers\Api\V1\ExerciseController;
use App\Http\Controllers\Api\V1\SetController;
use App\Http\Controllers\Api\V1\WorkoutController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->middleware('auth:tgwebapp')->group(function () {
    Route::get('/trainings', [TrainingController::class, 'index']);
    Route::post('/trainings', [TrainingController::class, 'store']);
    Route::get('/trainings/{id}', [TrainingController::class, 'show']);
    Route::patch('/trainings/{id}/finish', [TrainingController::class, 'finish']);
    Route::post('/trainings/{id}/apply-preset/{workoutId}', [TrainingController::class, 'applyPreset']);

    Route::post('/trainings/{trainingId}/exercises', [ExerciseController::class, 'store']);
    Route::delete('/exercises/{id}', [ExerciseController::class, 'destroy']);

    Route::get('/exercises/{exerciseId}/sets', [SetController::class, 'index']);
    Route::post('/exercises/{exerciseId}/sets', [SetController::class, 'store']);
    Route::patch('/sets/{id}', [SetController::class, 'update']);
    Route::delete('/sets/{id}', [SetController::class, 'destroy']);

    Route::get('/workouts', [WorkoutController::class, 'index']);
    Route::post('/workouts', [WorkoutController::class, 'store']);
    Route::get('/workouts/{id}', [WorkoutController::class, 'show']);
    Route::patch('/workouts/{id}', [WorkoutController::class, 'update']);
    Route::delete('/workouts/{id}', [WorkoutController::class, 'destroy']);
    Route::post('/workouts/{workoutId}/exercises', [WorkoutController::class, 'storeExercise']);
    Route::delete('/workouts/exercises/{id}', [WorkoutController::class, 'destroyExercise']);
});
