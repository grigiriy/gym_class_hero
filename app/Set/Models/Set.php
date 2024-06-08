<?php

namespace App\Set\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Exercise\Models\Exercise;
use Database\Factories\SetFactory;

class Set extends Model
{
    use HasFactory;

    protected static function newFactory(): SetFactory
    {
        return SetFactory::new();
    }

    protected $fillable = [
        'exercise_id',
        'count',
        'weight',
        'sort_order',
    ];

    public function exercise(): BelongsTo
    {
        return $this->belongsTo(Exercise::class);
    }
}
