<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TrainingResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'time_start' => $this->time_start,
            'time_end' => $this->time_end,
            'exercises' => ExerciseResource::collection($this->whenLoaded('exercises')),
            'created_at' => $this->created_at,
        ];
    }
}
