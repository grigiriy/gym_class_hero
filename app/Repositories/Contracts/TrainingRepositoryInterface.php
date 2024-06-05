<?php
namespace App\Repositories;

use App\Models\Training;

class TrainingRepository
{
    /**
     * Создание новой тренировки.
     *
     * @param array $attributes Массив атрибутов тренировки (название и т.д.).
     * @return Training Созданная тренировка.
     */
    public function create(array $attributes): Training
    {
        return Training::create($attributes);
    }

    /* 
     * Дополнительные методы для работы с тренировками.
     * ...
     */
}