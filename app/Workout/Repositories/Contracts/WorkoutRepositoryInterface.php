<?php

namespace App\Workout\Repositories\Contracts;

use App\Workout\Models\Workout;

interface WorkoutRepositoryInterface
{
    public function find(int $id): ?Workout;
    public function create(array $attributes): Workout;
    public function delete(Workout $workout): bool;
}
