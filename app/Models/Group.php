<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Group extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'image',
        'order_column',
    ];

    // Relation: Group has many courses
    public function courses(): HasMany
    {
        return $this->hasMany(Course::class);
    }

    // Optionally: get the active course
    public function activeCourse()
    {
        return $this->hasOne(Course::class)->where('active', true);
    }
}
