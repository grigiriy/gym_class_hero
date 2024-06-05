<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// в файле app/Models/Exercise.php
class Exercise extends Model {
    public function training() {
        return $this->belongsTo(Training::class);
    }

    public function baseExercise() {
        return $this->belongsTo(BaseExercise::class);
    }

    public function sets() {
        return $this->hasMany(Set::class);
    }
    
    // Другие свойства модели
}