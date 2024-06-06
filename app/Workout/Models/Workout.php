<?php

namespace App\Workout\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Exercise\Models\Exercise;

class Workout extends Model
{
    public function exercises(): HasMany
    {
        return $this->hasMany(Exercise::class);
    }
}
