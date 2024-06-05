<?php
namespace App\Repositories;

use App\Models\Exercise;

class ExerciseRepository
{
    /**
     * Создание нового упражнения.
     *
     * @param array $attributes Массив атрибутов упражнения (название и т.д.).
     * @return Exercise Созданное упражнение.
     */
    public function create(array $attributes): Exercise
    {
        return Exercise::create($attributes);
    }

    /* 
     * Дополнительные методы для работы с упражнениями.
     * ...
     */
}