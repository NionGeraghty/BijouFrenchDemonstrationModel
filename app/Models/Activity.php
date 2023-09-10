<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'order_column', 'worksheet', 'answers', 'course_id'];

    public function course() {
        return $this->belongsTo(Course::class);
    }
}
