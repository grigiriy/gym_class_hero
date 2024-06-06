<?php

namespace App\Exercise\Services\Contracts;

use App\Exercise\Models\Exercise;
use Illuminate\Support\Collection;

interface ExerciseServiceInterface
{
    public function createExercise(array $data): Exercise;
    public function updateExercise(Exercise $exercise, array $data): Exercise;
    public function deleteExercise(Exercise $exercise): bool;
    public function getExerciseById(int $id): ?Exercise;
    public function getExercisesForTraining(int $trainingId): Collection;
}
