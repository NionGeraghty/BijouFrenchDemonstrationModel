<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    protected $fillable = [
        'title',
        'access_code',
        'article_id',
        'cohort_id',
        'reorder_games',
        'odd_one_out_games',
        'category_games',
        'match_up_games',
        'games_active',
        'active',
    ];

    protected $casts = [
        'reorder_games' => 'array',
        'odd_one_out_games' => 'array',
        'category_games' => 'array',
        'match_up_games' => 'array',
        'games_active' => 'boolean',
        'active' => 'boolean',
    ];

    public function article(): BelongsTo
    {
        return $this->belongsTo(Article::class);
    }

    public function cohort(): BelongsTo
    {
        return $this->belongsTo(Cohort::class);
    }

    public function activities()
    {
        return $this->hasMany(Activity::class)->orderBy('order_column');
    }

    public function songs(): HasMany
    {
        return $this->hasMany(Song::class)->orderBy('order_column');
    }

    public function gameAttempts(): HasMany
    {
        return $this->hasMany(GameAttempt::class);
    }

    protected static function booted()
    {
        static::saving(function ($course) {
            if ($course->active && $course->cohort_id) {
                // Deactivate all other courses in the same cohort
                static::where('cohort_id', $course->cohort_id)
                    ->where('id', '!=', $course->id)
                    ->update(['active' => false]);
            }
        });
    }

}
