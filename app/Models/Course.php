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
        'reorder_games',
        'odd_one_out_games',
        'category_games',
        'match_up_games',
        'games_active',
    ];

    protected $casts = [
        'games_active' => 'boolean',
    ];

    /**
     * Transform game data from Filament's flat structure to the nested structure
     * expected by the frontend: [{"fields": {"question": "...", "solution": "..."}}]
     */
    protected function transformGamesForStorage(array $games): array
    {
        return collect($games)->map(function ($game) {
            // If already in the correct format, return as-is
            if (isset($game['fields'])) {
                return $game;
            }
            // Otherwise, wrap in fields structure
            return ['fields' => $game];
        })->toArray();
    }

    /**
     * Transform game data from nested structure to flat for Filament admin
     */
    protected function transformGamesForAdmin(array $games): array
    {
        return collect($games)->map(function ($game) {
            // If in nested format, extract fields
            if (isset($game['fields'])) {
                return $game['fields'];
            }
            // Otherwise, return as-is
            return $game;
        })->toArray();
    }

    // Accessors for Filament admin (flat structure)
    public function getReorderGamesAttribute($value): array
    {
        if (!$value) {
            return [];
        }
        $games = is_string($value) ? json_decode($value, true) : $value;
        return $this->transformGamesForAdmin($games ?? []);
    }

    public function getOddOneOutGamesAttribute($value): array
    {
        if (!$value) {
            return [];
        }
        $games = is_string($value) ? json_decode($value, true) : $value;
        return $this->transformGamesForAdmin($games ?? []);
    }

    public function getCategoryGamesAttribute($value): array
    {
        if (!$value) {
            return [];
        }
        $games = is_string($value) ? json_decode($value, true) : $value;
        return $this->transformGamesForAdmin($games ?? []);
    }

    public function getMatchUpGamesAttribute($value): array
    {
        if (!$value) {
            return [];
        }
        $games = is_string($value) ? json_decode($value, true) : $value;
        return $this->transformGamesForAdmin($games ?? []);
    }

    // Mutators for saving (nested structure)
    public function setReorderGamesAttribute($value): void
    {
        $this->attributes['reorder_games'] = json_encode($this->transformGamesForStorage($value ?? []));
    }

    public function setOddOneOutGamesAttribute($value): void
    {
        $this->attributes['odd_one_out_games'] = json_encode($this->transformGamesForStorage($value ?? []));
    }

    public function setCategoryGamesAttribute($value): void
    {
        $this->attributes['category_games'] = json_encode($this->transformGamesForStorage($value ?? []));
    }

    public function setMatchUpGamesAttribute($value): void
    {
        $this->attributes['match_up_games'] = json_encode($this->transformGamesForStorage($value ?? []));
    }

    /**
     * Get games in the format expected by the frontend API
     * (with the 'fields' wrapper)
     */
    public function toArrayForApi(): array
    {
        $array = parent::toArray();
        
        // Transform games back to nested format for API
        foreach (['reorder_games', 'odd_one_out_games', 'category_games', 'match_up_games'] as $gameType) {
            if (isset($this->attributes[$gameType])) {
                $games = json_decode($this->attributes[$gameType], true) ?? [];
                $array[$gameType] = $games; // Already in nested format from database
            }
        }
        
        return $array;
    }

    public function article(): BelongsTo
    {
        return $this->belongsTo(Article::class);
    }

    public function groups(): HasMany
    {
        return $this->hasMany(Group::class);
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


}
