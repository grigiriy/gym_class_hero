<?php

namespace App\Repositories\Contracts;

use App\Models\Exercise;

interface ExerciseRepositoryInterface
{
    /**
     * Найти упражнение по идентификатору.
     *
     * @param int $id Идентификатор упражнения.
     * @return Exercise|null Возвращает упражнение или null, если ничего не найдено.
     */
    public function find(int $id): ?Exercise;

    /**
     * Создать новое упражнение с заданными атрибутами.
     *
     * @param array $attributes Атрибуты для создания упражнения в базе.
     * @return Exercise Созданное упражнение.
     */
    public function create(array $attributes): Exercise;
}
