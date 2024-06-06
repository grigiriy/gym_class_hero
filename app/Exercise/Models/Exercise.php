<?php

namespace App\Exercise\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Training\Models\Training;
use App\Set\Models\Set;

class Exercise extends Model
{
    public function training(): BelongsTo
    {
        return $this->belongsTo(Training::class);
    }

    public function sets(): HasMany
    {
        return $this->hasMany(Set::class);
    }
}
