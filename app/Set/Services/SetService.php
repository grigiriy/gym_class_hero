<?php

namespace App\Set\Services;

use App\Set\Models\Set;
use App\Set\Repositories\Contracts\SetRepositoryInterface;
use App\Set\Services\Contracts\SetServiceInterface;
use Illuminate\Support\Collection;

class SetService implements SetServiceInterface
{
    public function __construct(
        private readonly SetRepositoryInterface $setRepository
    ) {}

    public function createSet(array $data): Set
    {
        return $this->setRepository->create($data);
    }

    public function updateSet(Set $set, array $data): Set
    {
        return $this->setRepository->update($set, $data);
    }

    public function deleteSet(Set $set): bool
    {
        return $this->setRepository->delete($set);
    }

    public function getSetsForExercise(int $exerciseId): Collection
    {
        return $this->setRepository->findByExerciseId($exerciseId);
    }

    public function getSetById(int $id): ?Set
    {
        return $this->setRepository->find($id);
    }
}
