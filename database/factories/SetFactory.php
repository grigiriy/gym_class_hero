<?php

namespace Database\Factories;

use App\Set\Models\Set;
use App\Exercise\Models\Exercise;
use Illuminate\Database\Eloquent\Factories\Factory;

class SetFactory extends Factory
{
    protected $model = Set::class;

    public function definition(): array
    {
        return [
            'exercise_id' => Exercise::factory(),
            'count' => fake()->randomElement([6, 8, 10, 12, 15]),
            'weight' => fake()->randomFloat(2, 10, 150),
            'sort_order' => fake()->numberBetween(1, 5),
        ];
    }
}
