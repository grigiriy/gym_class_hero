<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExerciseResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'training_id' => $this->training_id,
            'name' => $this->name,
            'sort_order' => $this->sort_order,
            'sets' => SetResource::collection($this->whenLoaded('sets')),
            'created_at' => $this->created_at,
        ];
    }
}
