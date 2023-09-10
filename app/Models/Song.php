<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'order_column', 'mp3',  'lyrics', 'course_id'];

    public function course() {
        return $this->belongsTo(Course::class);
    }
}
