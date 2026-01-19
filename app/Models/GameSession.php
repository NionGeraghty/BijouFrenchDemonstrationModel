<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GameSession extends Model
{
    protected $fillable = ['name', 'start_time', 'game_times', 'course_id'];

    protected $casts = [
        'game_times' => 'array', // this tells Laravel to convert JSON -> array
    ];
}

