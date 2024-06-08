<?php

namespace Database\Factories;

use App\Workout\Models\Workout;
use App\User\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class WorkoutFactory extends Factory
{
    protected $model = Workout::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'name' => fake()->randomElement([
                'Грудь + трицепс',
                'Спина + бицепс',
                'Ноги + плечи',
                'Верх тела',
                'Низ тела',
                'Полное тело',
                'Pull day',
                'Push day',
                'Leg day',
            ]),
        ];
    }
}
