<?php

namespace App\Exercise\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Training\Models\Training;
use App\Set\Models\Set;
use Database\Factories\ExerciseFactory;

class Exercise extends Model
{
    use HasFactory;

    protected $table = 'excercises';

    protected static function newFactory(): ExerciseFactory
    {
        return ExerciseFactory::new();
    }

    protected $fillable = [
        'training_id',
        'name',
        'sort_order',
    ];

    public function training(): BelongsTo
    {
        return $this->belongsTo(Training::class);
    }

    public function sets(): HasMany
    {
        return $this->hasMany(Set::class);
    }
}
