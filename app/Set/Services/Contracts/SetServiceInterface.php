<?php

namespace App\Set\Services\Contracts;

use App\Set\Models\Set;
use Illuminate\Support\Collection;

interface SetServiceInterface
{
    public function createSet(array $data): Set;
    public function updateSet(Set $set, array $data): Set;
    public function deleteSet(Set $set): bool;
    public function getSetsForExercise(int $exerciseId): Collection;
    public function getSetById(int $id): ?Set;
}
