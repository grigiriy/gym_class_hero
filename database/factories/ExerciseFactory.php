<?php

namespace Database\Factories;

use App\Exercise\Models\Exercise;
use App\Training\Models\Training;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExerciseFactory extends Factory
{
    protected $model = Exercise::class;

    public function definition(): array
    {
        return [
            'training_id' => Training::factory(),
            'name' => fake()->randomElement([
                'Жим штанги лёжа',
                'Приседания со штангой',
                'Становая тяга',
                'Подтягивания',
                'Отжимания на брусьях',
                'Тяга штанги в наклоне',
                'Разгибание рук на блоке',
                'Сгибание рук с гантелями',
                'Жим гантелей сидя',
                'Выпады с гантелями',
            ]),
            'sort_order' => fake()->numberBetween(0, 10),
        ];
    }
}
