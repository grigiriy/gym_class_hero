<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Exercise\StoreExerciseRequest;
use App\Http\Resources\ExerciseResource;
use App\Exercise\Models\Exercise;
use App\Exercise\Services\Contracts\ExerciseServiceInterface;
use App\Training\Services\Contracts\TrainingServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ExerciseController extends Controller
{
    public function __construct(
        private readonly ExerciseServiceInterface $exerciseService,
        private readonly TrainingServiceInterface $trainingService
    ) {}

    public function store(StoreExerciseRequest $request, int $trainingId)
    {
        $training = $this->trainingService->getTrainingById($trainingId);

        if (!$training) {
            return new JsonResponse(['error' => 'Training not found'], 404);
        }

        $exercise = $this->exerciseService->createExercise([
            'training_id' => $trainingId,
            'name' => $request->validated('name'),
            'sort_order' => $request->validated('sort_order', 0),
        ]);

        return new ExerciseResource($exercise);
    }

    public function destroy(int $id)
    {
        $exercise = $this->exerciseService->getExerciseById($id);

        if (!$exercise) {
            return new JsonResponse(['error' => 'Exercise not found'], 404);
        }

        $this->exerciseService->deleteExercise($exercise);

        return new JsonResponse(null, 204);
    }
}
