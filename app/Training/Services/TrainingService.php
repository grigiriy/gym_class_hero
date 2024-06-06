<?php

namespace App\Training\Services;

use App\Training\Models\Training;
use App\Training\Repositories\Contracts\TrainingRepositoryInterface;
use App\Training\Services\Contracts\TrainingServiceInterface;
use Illuminate\Support\Collection;

class TrainingService implements TrainingServiceInterface
{
    public function __construct(
        private readonly TrainingRepositoryInterface $trainingRepository
    ) {}

    public function createTraining(array $data): Training
    {
        return $this->trainingRepository->create($data);
    }

    public function updateTraining(Training $training, array $data): Training
    {
        $training->update($data);
        return $training;
    }

    public function deleteTraining(Training $training): bool
    {
        return $training->delete();
    }

    public function getTrainingById(int $id): ?Training
    {
        return $this->trainingRepository->find($id);
    }

    public function getTrainingsForUser(int $userId): Collection
    {
        return $this->trainingRepository->findByUserId($userId);
    }
}
