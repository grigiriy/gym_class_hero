<?php

use App\Http\Controllers\Api\V1\TrainingController;
use App\Http\Controllers\Api\V1\ExerciseController;
use App\Http\Controllers\Api\V1\SetController;
use App\Http\Controllers\Api\V1\WorkoutController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::get('/debug', function (\Illuminate\Http\Request $request) {
        $initData = $request->query('init_data');

        if (!$initData) {
            return response()->json(['error' => 'Pass ?init_data=... to test verification']);
        }

        $token = config('services.telegram.bot_token');
        $parsed = [];
        foreach (explode('&', $initData) as $pair) {
            $parts = explode('=', $pair, 2);
            if (count($parts) === 2) {
                $key = urldecode($parts[0]);
                $value = urldecode($parts[1]);
                $parsed[$key] = $key === 'user' ? substr($value, 0, 30) . '...' : $value;
            }
        }

        $dataNoHash = [];
        foreach (explode('&', $initData) as $pair) {
            $parts = explode('=', $pair, 2);
            if (count($parts) === 2) {
                $key = urldecode($parts[0]);
                $value = urldecode($parts[1]);
                if ($key !== 'hash') {
                    $dataNoHash[$key] = $value;
                }
            }
        }
        ksort($dataNoHash);
        $pairs = [];
        foreach ($dataNoHash as $k => $v) {
            $pairs[] = "{$k}={$v}";
        }
        $dataCheckString = implode("\n", $pairs);

        $secretKey = hash_hmac('sha256', $token, 'WebAppData');
        $calculatedHash = hash_hmac('sha256', $dataCheckString, $secretKey);

        $hashFromInit = $parsed['hash'] ?? 'missing';

        $token = config('services.telegram.bot_token');

        return response()->json([
            'parsed_keys' => array_keys($parsed),
            'received_hash' => $hashFromInit,
            'calculated_hash' => $calculatedHash,
            'hash_match' => hash_equals($calculatedHash, $hashFromInit),
            'data_check_string' => $dataCheckString,
            'token_first4' => substr($token, 0, 4),
            'token_last4' => substr($token, -4),
            'token_length' => strlen($token),
        ]);
    });
});

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
