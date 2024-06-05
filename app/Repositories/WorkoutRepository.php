<?php
namespace App\Repositories;

use App\Models\BaseExercise;

class BaseExerciseRepository
{
    /**
     * Создание нового пресета-упражнения в базе данных.
     *
     * @param array $attributes Массив атрибутов упражнения (название и т.д.).
     * @return BaseExercise Созданное упрежнение в базе.
     */
    public function create(array $attributes): BaseExercise
    {
        return BaseExercise::create($attributes);
    }

    /* 
     * Дополнительные методы для работы с базой упражнений.
     * ...
     */
}