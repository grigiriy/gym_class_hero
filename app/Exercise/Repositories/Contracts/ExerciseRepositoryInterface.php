<?php

namespace App\Exercise\Repositories\Contracts;

use App\Exercise\Models\Exercise;
use Illuminate\Support\Collection;

interface ExerciseRepositoryInterface
{
    public function find(int $id): ?Exercise;
    public function create(array $attributes): Exercise;
    public function findByTrainingId(int $trainingId): Collection;
    public function delete(Exercise $exercise): bool;
}
