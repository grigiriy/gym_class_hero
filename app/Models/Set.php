<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Exercise; // вскод не подчеркивает это - надо ли каждый раз импортить, или он из Модели теперь подтягивается?


class Set extends Model {
    public function exercise() {
        return $this->belongsTo(Exercise::class);
    }

    // Другие свойства модели
}