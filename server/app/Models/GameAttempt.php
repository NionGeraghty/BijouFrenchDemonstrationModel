<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


function pretty_format_seconds($seconds) {
    $hours = floor($seconds / 3600);
    $minutes = floor(($seconds % 3600) / 60);
    $seconds = $seconds % 60;

    $time = '';
    if ($hours > 0) {
        $time .= $hours . 'h ';
    }
    if ($minutes > 0) {
        $time .= $minutes . 'm ';
    }
    if ($seconds > 0) {
        $time .= $seconds . 's';
    }

    return $time;
}


class GameAttempt extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'name',
        'nonce',
        'completed_at',
        'game_data',
    ];

    protected $casts = [
        'game_data' => 'array',
    ];

    protected $appends = ['time_spent', 'date'];

    public function course() {
        return $this->belongsTo(Course::class);
    }

    public function getDateAttribute() {
        // return 1th Month
        return $this->created_at->format('jS F');

    }

    public function getTimeSpentAttribute() {
        if ($this->completed_at) {
            return pretty_format_seconds(\Carbon\Carbon::parse($this->completed_at)->diffInSeconds($this->created_at));
        }

        // find the latest completed at from game_data
        $latestCompletedAt = collect($this->game_data)->max('completedAt');
        if ($latestCompletedAt) {
            return pretty_format_seconds(\Carbon\Carbon::parse($latestCompletedAt)->diffInSeconds($this->created_at));
        }

        return null;
    }
}
