<?php

namespace App\Workout\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Exercise\Models\Exercise;
use App\User\Models\User;
use Database\Factories\WorkoutFactory;

class Workout extends Model
{
    use HasFactory;

    protected static function newFactory(): WorkoutFactory
    {
        return WorkoutFactory::new();
    }

    protected $fillable = [
        'user_id',
        'name',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function exercises(): HasMany
    {
        return $this->hasMany(Exercise::class);
    }
}
