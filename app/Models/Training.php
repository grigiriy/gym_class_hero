<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Exercise;


class Training extends Model 
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'id',
        'user_id',
        'time_start',
        'time_end',
        // другие атрибуты, как 'description'
    ];

    public function exercises() {
        return $this->hasMany(Exercise::class);
    }

}

?>