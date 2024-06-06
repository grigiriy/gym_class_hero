<?php

namespace App\Training\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Exercise\Models\Exercise;

class Training extends Model
{
    protected $fillable = [
        'user_id',
        'time_start',
        'time_end',
    ];

    public function exercises(): HasMany
    {
        return $this->hasMany(Exercise::class);
    }
}
