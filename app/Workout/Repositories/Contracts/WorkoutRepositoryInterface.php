<?php

namespace App\Workout\Repositories\Contracts;

use App\Workout\Models\Workout;
use Illuminate\Support\Collection;

interface WorkoutRepositoryInterface
{
    public function find(int $id): ?Workout;
    public function create(array $attributes): Workout;
    public function delete(Workout $workout): bool;
    public function findByUserId(int $userId): Collection;
}
