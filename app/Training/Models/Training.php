<?php

namespace App\Training\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Exercise\Models\Exercise;
use App\User\Models\User;
use Database\Factories\TrainingFactory;

class Training extends Model
{
    use HasFactory;

    protected static function newFactory(): TrainingFactory
    {
        return TrainingFactory::new();
    }

    protected $fillable = [
        'user_id',
        'time_start',
        'time_end',
    ];

    protected $casts = [
        'time_start' => 'datetime',
        'time_end' => 'datetime',
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
