<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = ['
        title',
        "article_id",
        "cohort_id",
        "access_code",
        "reorder_games",
        "odd_one_out_games",
        "category_games",
        "games_active",
        "match_up_games",
    ];

    protected $casts = [
        'reorder_games' => 'array',
        'odd_one_out_games' => 'array',
        'category_games' => 'array',
        'match_up_games' => 'array',
    ];

    public function cohort() {
        return $this->belongsTo(Cohort::class);
    }

    public function activities() {
        return $this->hasMany(Activity::class);
    }

    public function songs() {
        return $this->hasMany(Song::class);
    }

    public function article() {
        return $this->belongsTo(Article::class);
    }

    public function gameAttempts() {
        return $this->hasMany(GameAttempt::class);
    }
}
