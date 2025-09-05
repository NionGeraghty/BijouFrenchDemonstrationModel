<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GameAttempt extends Model
{
    protected $fillable = [
        'course_id',
        'name',
        'completed_at',
        'game_data',
        'nonce',
    ];

    protected $casts = [
        'game_data' => 'array',
        'completed_at' => 'datetime',
    ];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }
}
