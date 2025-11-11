<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class Cohort extends Model implements Sortable
{
    use Sluggable;
    use SortableTrait;
    use HasFactory;

    protected $fillable = ['title', 'order_column', 'slug', 'image', 'active' ];

    protected $casts = [
        'active' => 'boolean',
    ];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function course() {
        $course = $this->hasOne(Course::class);
        return $course;
    }

}
