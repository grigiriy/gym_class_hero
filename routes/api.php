<?php

use App\Http\Controllers\Api\V1\TrainingController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::get('/trainings', [TrainingController::class, 'index']);
    Route::post('/trainings', [TrainingController::class, 'store']);
    Route::get('/trainings/{id}', [TrainingController::class, 'show']);
    Route::patch('/trainings/{id}/finish', [TrainingController::class, 'finish']);
});
