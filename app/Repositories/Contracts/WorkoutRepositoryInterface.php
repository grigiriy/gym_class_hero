<?php

namespace App\Repositories\Contracts;

use App\Models\Workout;

interface WorkoutRepositoryInterface
{
    /**
     * Найти упражнение по идентификатору.
     *
     * @param int $id Идентификатор упражнения из базы.
     * @return Workout|null Возвращает упражнение или null, если ничего не найдено.
     */
    public function find(int $id): ?Workout;

    /**
     * Создать новое упражнение в базе с заданными атрибутами.
     *
     * @param array $attributes Атрибуты для создания упражнения в базе.
     * @return Workout Созданное упражнение в базе.
     */
    public function create(array $attributes): Workout;
}
