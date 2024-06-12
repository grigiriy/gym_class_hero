<?php

namespace App\Set\Repositories;

use App\Set\Models\Set;
use App\Set\Repositories\Contracts\SetRepositoryInterface;
use Illuminate\Support\Collection;

class SetRepository implements SetRepositoryInterface
{
    public function find(int $id): ?Set
    {
        return Set::find($id);
    }

    public function create(array $attributes): Set
    {
        return Set::create($attributes);
    }

    public function update(Set $set, array $attributes): Set
    {
        $set->update($attributes);
        return $set;
    }

    public function delete(Set $set): bool
    {
        return $set->delete();
    }

    public function findByExerciseId(int $exerciseId): Collection
    {
        return Set::where('exercise_id', $exerciseId)
            ->orderBy('sort_order')
            ->get();
    }
}
