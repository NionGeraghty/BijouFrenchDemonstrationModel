<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Course;
use App\Models\Activity;
use App\Models\Song;

/*
|--------------------------------------------------------------------------
| Card API Routes
|--------------------------------------------------------------------------
|
| Here is where you may register API routes for your card. These routes
| are loaded by the ServiceProvider of your card. You're free to add
| as many additional routes to this file as your card may require.
|
*/

Route::get('/', function (Request $request) {
    // return the courses with cohort_id not null
    $courses = Course::whereNotNull('cohort_id')->get();

    // attach activities to each course
    $courses->each(function ($course) {
        $course->activities = Activity::where('course_id', $course->id)->get();
    });

    // attach songs
    $courses->each(function ($course) {
        $course->songs = Song::where('course_id', $course->id)->get();
    });

    return $courses;

});

// Route::get("/last-updated", function() {
//     // find the last updated activity, song or article and return the model
//     $lastActivity = Activity::orderBy('updated_at', 'desc')->first();
//     $lastSong = Song::orderBy('updated_at', 'desc')->first();
//     $lastCourse = Course::orderBy('updated_at', 'desc')->first();

//     // calculate the most recent update
//     $result = $lastActivity;
//     if ($lastSong->updated_at > $result->updated_at) {
//         $result = $lastSong;
//     }
//     if ($lastCourse->updated_at > $result->updated_at) {
//         $result = $lastCourse;
//     }

//     return $result;
// });
