<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Training\StoreTrainingRequest;
use App\Http\Resources\TrainingResource;
use App\Training\Models\Training;
use App\Training\Services\Contracts\TrainingServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TrainingController extends Controller
{
    public function __construct(
        private readonly TrainingServiceInterface $trainingService
    ) {}

    public function index(Request $request)
    {
        $trainings = $this->trainingService->getTrainingsForUser($request->user()->id);

        return TrainingResource::collection($trainings);
    }

    public function store(StoreTrainingRequest $request)
    {
        $training = $this->trainingService->createTraining([
            'user_id' => $request->user()->id,
            'time_start' => $request->validated('time_start') ?? now(),
        ]);

        return new TrainingResource($training);
    }

    public function show(int $id)
    {
        $training = $this->trainingService->getTrainingById($id);

        if (!$training) {
            return new JsonResponse(['error' => 'Training not found'], 404);
        }

        return new TrainingResource($training);
    }

    public function finish(int $id)
    {
        $training = $this->trainingService->getTrainingById($id);

        if (!$training) {
            return new JsonResponse(['error' => 'Training not found'], 404);
        }

        $training = $this->trainingService->updateTraining($training, [
            'time_end' => now(),
        ]);

        return new TrainingResource($training);
    }
}
