<?php

namespace App\Workout\Services;

use App\Workout\Models\Workout;
use App\Workout\Repositories\Contracts\WorkoutRepositoryInterface;
use App\Workout\Services\Contracts\WorkoutServiceInterface;
use Illuminate\Support\Collection;

class WorkoutService implements WorkoutServiceInterface
{
    public function __construct(
        private readonly WorkoutRepositoryInterface $workoutRepository
    ) {}

    public function createWorkout(array $data): Workout
    {
        return $this->workoutRepository->create($data);
    }

    public function updateWorkout(Workout $workout, array $data): Workout
    {
        $workout->update($data);
        return $workout;
    }

    public function deleteWorkout(Workout $workout): bool
    {
        return $workout->delete();
    }

    public function getWorkoutById(int $id): ?Workout
    {
        return $this->workoutRepository->find($id);
    }

    public function getWorkoutsForUser(int $userId): Collection
    {
        return $this->workoutRepository->findByUserId($userId);
    }
}
