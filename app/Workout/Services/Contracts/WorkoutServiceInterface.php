<?php

namespace App\Workout\Services\Contracts;

use App\Workout\Models\Workout;
use Illuminate\Support\Collection;

interface WorkoutServiceInterface
{
    public function createWorkout(array $data): Workout;
    public function updateWorkout(Workout $workout, array $data): Workout;
    public function deleteWorkout(Workout $workout): bool;
    public function getWorkoutById(int $id): ?Workout;
    public function getWorkoutsForUser(int $userId): Collection;
}
