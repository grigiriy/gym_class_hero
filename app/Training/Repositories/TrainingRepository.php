<?php

namespace App\Training\Repositories;

use App\Training\Models\Training;
use App\Training\Repositories\Contracts\TrainingRepositoryInterface;
use Illuminate\Support\Collection;

class TrainingRepository implements TrainingRepositoryInterface
{
    public function find(int $id): ?Training
    {
        return Training::find($id);
    }

    public function create(array $attributes): Training
    {
        return Training::create($attributes);
    }

    public function findByUserId(int $userId): Collection
    {
        return Training::where('user_id', $userId)->get();
    }

    public function delete(Training $training): bool
    {
        return $training->delete();
    }
}
