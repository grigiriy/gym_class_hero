<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\WorkoutResource;
use App\Exercise\Services\Contracts\ExerciseServiceInterface;
use App\Workout\Services\Contracts\WorkoutServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WorkoutController extends Controller
{
    public function __construct(
        private readonly WorkoutServiceInterface $workoutService,
        private readonly ExerciseServiceInterface $exerciseService
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

    public function storeExercise(Request $request, int $workoutId)
    {
        $workout = $this->workoutService->getWorkoutById($workoutId);

        if (!$workout) {
            return new JsonResponse(['error' => 'Workout not found'], 404);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'sort_order' => 'nullable|integer',
        ]);

        $exercise = $this->exerciseService->createExercise([
            'workout_id' => $workoutId,
            'name' => $request->input('name'),
            'sort_order' => $request->input('sort_order', 0),
        ]);

        return new WorkoutResource($workout->fresh(['exercises']));
    }

    public function destroyExercise(int $id)
    {
        $exercise = $this->exerciseService->getExerciseById($id);

        if (!$exercise || !$exercise->workout_id) {
            return new JsonResponse(['error' => 'Exercise not found'], 404);
        }

        $workoutId = $exercise->workout_id;
        $this->exerciseService->deleteExercise($exercise);

        $workout = $this->workoutService->getWorkoutById($workoutId);
        return new WorkoutResource($workout->fresh(['exercises']));
    }
}
