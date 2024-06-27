<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\WorkoutResource;
use App\Workout\Services\Contracts\WorkoutServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WorkoutController extends Controller
{
    public function __construct(
        private readonly WorkoutServiceInterface $workoutService
    ) {}

    public function index(Request $request)
    {
        $workouts = $this->workoutService->getWorkoutsForUser($request->user()->id);

        return WorkoutResource::collection($workouts);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $workout = $this->workoutService->createWorkout([
            'user_id' => $request->user()->id,
            'name' => $request->input('name'),
        ]);

        return new WorkoutResource($workout);
    }

    public function show(int $id)
    {
        $workout = $this->workoutService->getWorkoutById($id);

        if (!$workout) {
            return new JsonResponse(['error' => 'Workout not found'], 404);
        }

        return new WorkoutResource($workout);
    }

    public function update(Request $request, int $id)
    {
        $workout = $this->workoutService->getWorkoutById($id);

        if (!$workout) {
            return new JsonResponse(['error' => 'Workout not found'], 404);
        }

        $request->validate([
            'name' => 'sometimes|string|max:255',
        ]);

        $workout = $this->workoutService->updateWorkout($workout, $request->only('name'));

        return new WorkoutResource($workout);
    }

    public function destroy(int $id)
    {
        $workout = $this->workoutService->getWorkoutById($id);

        if (!$workout) {
            return new JsonResponse(['error' => 'Workout not found'], 404);
        }

        $this->workoutService->deleteWorkout($workout);

        return new JsonResponse(null, 204);
    }
}
