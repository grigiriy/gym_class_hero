<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Exercise;


class Workout extends Model {
    public function exercises() {
        return $this->hasMany(Exercise::class);
    }

    // Другие свойства модели
}