<?php

namespace App\Set\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Exercise\Models\Exercise;

class Set extends Model
{
    public function exercise(): BelongsTo
    {
        return $this->belongsTo(Exercise::class);
    }
}
