<?php

namespace App\Set\Repositories\Contracts;

use App\Set\Models\Set;
use Illuminate\Support\Collection;

interface SetRepositoryInterface
{
    public function find(int $id): ?Set;
    public function create(array $attributes): Set;
    public function update(Set $set, array $attributes): Set;
    public function delete(Set $set): bool;
    public function findByExerciseId(int $exerciseId): Collection;
}
