<?php

namespace App\Workout\Repositories;

use App\Workout\Models\Workout;
use App\Workout\Repositories\Contracts\WorkoutRepositoryInterface;
use Illuminate\Support\Collection;

class WorkoutRepository implements WorkoutRepositoryInterface
{
    public function find(int $id): ?Workout
    {
        return Workout::with('exercises')->find($id);
    }

    public function create(array $attributes): Workout
    {
        return Workout::create($attributes);
    }

    public function delete(Workout $workout): bool
    {
        return $workout->delete();
    }

    public function findByUserId(int $userId): Collection
    {
        return Workout::with('exercises')->where('user_id', $userId)->get();
    }
}
