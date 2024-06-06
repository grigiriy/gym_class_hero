<?php

namespace App\Training\Repositories\Contracts;

use App\Training\Models\Training;
use Illuminate\Support\Collection;

interface TrainingRepositoryInterface
{
    public function find(int $id): ?Training;
    public function create(array $attributes): Training;
    public function findByUserId(int $userId): Collection;
    public function delete(Training $training): bool;
}
