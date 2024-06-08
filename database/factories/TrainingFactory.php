<?php

namespace Database\Factories;

use App\Training\Models\Training;
use App\User\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TrainingFactory extends Factory
{
    protected $model = Training::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'time_start' => fake()->dateTimeBetween('-30 days', 'now'),
            'time_end' => null,
        ];
    }

    public function finished(): static
    {
        return $this->state(fn (array $attributes) => [
            'time_end' => $attributes['time_start']
                ? fake()->dateTimeBetween($attributes['time_start'], '+2 hours')
                : fake()->dateTimeBetween('-1 hour', 'now'),
        ]);
    }
}
