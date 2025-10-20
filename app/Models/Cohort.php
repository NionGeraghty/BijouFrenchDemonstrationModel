<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



class Cohort extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'image',
        'order_column',
        'active',
        'course_id',

    ];

    protected $casts = [
        'active' => 'boolean',
    ];



    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
