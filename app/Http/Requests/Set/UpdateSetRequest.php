<?php

namespace App\Http\Requests\Set;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSetRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'count' => 'sometimes|integer|min:1',
            'weight' => 'sometimes|numeric|min:0',
            'sort_order' => 'sometimes|integer|min:0',
        ];
    }
}
