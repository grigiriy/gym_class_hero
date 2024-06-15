<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SetResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'exercise_id' => $this->exercise_id,
            'count' => $this->count,
            'weight' => $this->weight,
            'sort_order' => $this->sort_order,
            'created_at' => $this->created_at,
        ];
    }
}
