<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Set\StoreSetRequest;
use App\Http\Requests\Set\UpdateSetRequest;
use App\Http\Resources\SetResource;
use App\Set\Models\Set;
use App\Set\Services\Contracts\SetServiceInterface;
use App\Exercise\Services\Contracts\ExerciseServiceInterface;
use Illuminate\Http\JsonResponse;

class SetController extends Controller
{
    public function __construct(
        private readonly SetServiceInterface $setService,
        private readonly ExerciseServiceInterface $exerciseService
    ) {}

    public function index(int $exerciseId)
    {
        $exercise = $this->exerciseService->getExerciseById($exerciseId);

        if (!$exercise) {
            return new JsonResponse(['error' => 'Exercise not found'], 404);
        }

        $sets = $this->setService->getSetsForExercise($exerciseId);

        return SetResource::collection($sets);
    }

    public function store(StoreSetRequest $request, int $exerciseId)
    {
        $exercise = $this->exerciseService->getExerciseById($exerciseId);

        if (!$exercise) {
            return new JsonResponse(['error' => 'Exercise not found'], 404);
        }

        $set = $this->setService->createSet([
            'exercise_id' => $exerciseId,
            'count' => $request->validated('count'),
            'weight' => $request->validated('weight'),
            'sort_order' => $request->validated('sort_order', 0),
        ]);

        return new SetResource($set);
    }

    public function update(UpdateSetRequest $request, int $id)
    {
        $set = $this->setService->getSetById($id);

        if (!$set) {
            return new JsonResponse(['error' => 'Set not found'], 404);
        }

        $set = $this->setService->updateSet($set, $request->validated());

        return new SetResource($set);
    }

    public function destroy(int $id)
    {
        $set = $this->setService->getSetById($id);

        if (!$set) {
            return new JsonResponse(['error' => 'Set not found'], 404);
        }

        $this->setService->deleteSet($set);

        return new JsonResponse(null, 204);
    }
}
