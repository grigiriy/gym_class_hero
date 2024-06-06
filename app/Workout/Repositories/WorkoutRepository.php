<?php

namespace App\Workout\Repositories;

use App\Workout\Models\Workout;
use App\Workout\Repositories\Contracts\WorkoutRepositoryInterface;

class WorkoutRepository implements WorkoutRepositoryInterface
{
    public function find(int $id): ?Workout
    {
        return Workout::find($id);
    }

    public function create(array $attributes): Workout
    {
        return Workout::create($attributes);
    }

    public function delete(Workout $workout): bool
    {
        return $workout->delete();
    }
}
