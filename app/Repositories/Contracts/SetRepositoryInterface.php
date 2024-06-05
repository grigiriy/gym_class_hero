<?php
namespace App\Repositories;

use App\Models\Set;

class SetRepository
{
    /**
     * Создание нового сета.
     *
     * @param array $attributes Массив атрибутов сета (название и т.д.).
     * @return Set Созданый сет.
     */
    public function create(array $attributes): Set
    {
        return Set::create($attributes);
    }

    /* 
     * Дополнительные методы для работы с сетами.
     * ...
     */
}