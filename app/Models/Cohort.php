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
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}
