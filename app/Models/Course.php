<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = ['title', "article_id", "cohort_id", "access_code" ];

    public function cohort() {
        return $this->belongsTo(Cohort::class);
    }

    public function activities() {
        return $this->hasMany(Activity::class);
    }

    public function songs() {
        return $this->hasMany(Song::class);
    }
}
