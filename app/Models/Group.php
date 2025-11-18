<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Group extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'image',
        'order_column',
        'course_id',
    ];

    // Relation: Group belongs to a course
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

}
