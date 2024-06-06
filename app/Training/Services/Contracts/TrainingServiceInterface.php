<?php

namespace App\Training\Services\Contracts;

use App\Training\Models\Training;
use Illuminate\Support\Collection;

interface TrainingServiceInterface
{
    public function createTraining(array $data): Training;
    public function updateTraining(Training $training, array $data): Training;
    public function deleteTraining(Training $training): bool;
    public function getTrainingById(int $id): ?Training;
    public function getTrainingsForUser(int $userId): Collection;
}
