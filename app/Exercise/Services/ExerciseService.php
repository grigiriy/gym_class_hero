<?php

namespace App\Exercise\Services;

use App\Exercise\Models\Exercise;
use App\Exercise\Repositories\Contracts\ExerciseRepositoryInterface;
use App\Exercise\Services\Contracts\ExerciseServiceInterface;
use Illuminate\Support\Collection;

class ExerciseService implements ExerciseServiceInterface
{
    public function __construct(
        private readonly ExerciseRepositoryInterface $exerciseRepository
    ) {}

    public function createExercise(array $data): Exercise
    {
        return $this->exerciseRepository->create($data);
    }

    public function updateExercise(Exercise $exercise, array $data): Exercise
    {
        $exercise->update($data);
        return $exercise;
    }

    public function deleteExercise(Exercise $exercise): bool
    {
        return $exercise->delete();
    }

    public function getExerciseById(int $id): ?Exercise
    {
        return $this->exerciseRepository->find($id);
    }

    public function getExercisesForTraining(int $trainingId): Collection
    {
        return $this->exerciseRepository->findByTrainingId($trainingId);
    }
}
