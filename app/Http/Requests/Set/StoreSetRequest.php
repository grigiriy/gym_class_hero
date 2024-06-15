<?php

namespace App\Http\Requests\Set;

use Illuminate\Foundation\Http\FormRequest;

class StoreSetRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'count' => 'required|integer|min:1',
            'weight' => 'required|numeric|min:0',
            'sort_order' => 'nullable|integer|min:0',
        ];
    }
}
