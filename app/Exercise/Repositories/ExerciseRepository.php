<?php

namespace App\Exercise\Repositories;

use App\Exercise\Models\Exercise;
use App\Exercise\Repositories\Contracts\ExerciseRepositoryInterface;
use Illuminate\Support\Collection;

class ExerciseRepository implements ExerciseRepositoryInterface
{
    public function find(int $id): ?Exercise
    {
        return Exercise::find($id);
    }

    public function create(array $attributes): Exercise
    {
        return Exercise::create($attributes);
    }

    public function findByTrainingId(int $trainingId): Collection
    {
        return Exercise::where('training_id', $trainingId)->get();
    }

    public function delete(Exercise $exercise): bool
    {
        return $exercise->delete();
    }
}
