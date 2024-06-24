<?php

namespace Database\Seeders;

use App\User\Models\User;
use App\Training\Models\Training;
use App\Exercise\Models\Exercise;
use App\Set\Models\Set;
use App\Workout\Models\Workout;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Тестовый пользователь
        $user = User::factory()->create([
            'name' => 'Тестовый Пользователь',
            'email' => 'test@example.com',
            'telegram_id' => 12345678,
            'telegram_username' => 'testuser',
        ]);

        // Тренировка 1: Грудь + трицепс (завершена)
        $training1 = Training::factory()->finished()->create(['user_id' => $user->id]);

        $ex1 = Exercise::factory()->create([
            'training_id' => $training1->id,
            'name' => 'Жим штанги лёжа',
            'sort_order' => 1,
        ]);
        Set::factory()->create(['exercise_id' => $ex1->id, 'count' => 12, 'weight' => 60.00, 'sort_order' => 1]);
        Set::factory()->create(['exercise_id' => $ex1->id, 'count' => 10, 'weight' => 70.00, 'sort_order' => 2]);
        Set::factory()->create(['exercise_id' => $ex1->id, 'count' => 8, 'weight' => 80.00, 'sort_order' => 3]);

        $ex2 = Exercise::factory()->create([
            'training_id' => $training1->id,
            'name' => 'Разводка гантелей',
            'sort_order' => 2,
        ]);
        Set::factory()->create(['exercise_id' => $ex2->id, 'count' => 12, 'weight' => 16.00, 'sort_order' => 1]);
        Set::factory()->create(['exercise_id' => $ex2->id, 'count' => 12, 'weight' => 16.00, 'sort_order' => 2]);

        $ex3 = Exercise::factory()->create([
            'training_id' => $training1->id,
            'name' => 'Разгибание рук на блоке',
            'sort_order' => 3,
        ]);
        Set::factory()->create(['exercise_id' => $ex3->id, 'count' => 15, 'weight' => 25.00, 'sort_order' => 1]);
        Set::factory()->create(['exercise_id' => $ex3->id, 'count' => 12, 'weight' => 30.00, 'sort_order' => 2]);

        // Тренировка 2: Спина + бицепс (активная)
        $training2 = Training::factory()->create([
            'user_id' => $user->id,
            'time_start' => now()->subMinutes(30),
        ]);

        $ex4 = Exercise::factory()->create([
            'training_id' => $training2->id,
            'name' => 'Подтягивания',
            'sort_order' => 1,
        ]);
        Set::factory()->create(['exercise_id' => $ex4->id, 'count' => 10, 'weight' => 0, 'sort_order' => 1]);
        Set::factory()->create(['exercise_id' => $ex4->id, 'count' => 8, 'weight' => 0, 'sort_order' => 2]);

        $ex5 = Exercise::factory()->create([
            'training_id' => $training2->id,
            'name' => 'Тяга штанги в наклоне',
            'sort_order' => 2,
        ]);
        Set::factory()->create(['exercise_id' => $ex5->id, 'count' => 10, 'weight' => 60.00, 'sort_order' => 1]);

        // Пресеты тренировок
        Workout::factory()->create(['user_id' => $user->id, 'name' => 'Грудь + трицепс']);
        Workout::factory()->create(['user_id' => $user->id, 'name' => 'Спина + бицепс']);
        Workout::factory()->create(['user_id' => $user->id, 'name' => 'Ноги + плечи']);
    }
}
