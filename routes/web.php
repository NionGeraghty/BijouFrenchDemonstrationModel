<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\Cohort;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\AboutSueController;
use App\Http\Controllers\AboutBijouFrenchController;
use App\Http\Controllers\SongsController;
use App\Http\Controllers\ActivitiesController;

Route::get('/', function () {
    $cohorts = Cohort::all();

        $courses = $cohorts->map(fn($cohort) =>[
            'title' => $cohort->title,
            'slug' => $cohort->slug,
        ]
        );

    return Inertia::render('welcome',[
            'courses'=> $courses,
        ]);
})->name('home');

Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');

//Route::get('/courses/{course}/{page?}', [CourseController::class, 'show'])
//    ->where('page', 'activitysheets|songs')
//    ->name('courses.show');

Route::get('/aboutsue', [AboutSueController::class, 'index'])->name('aboutsue.index');
Route::get('/aboutbijoufrench', [AboutBijouFrenchController::class, 'index'])->name('aboutbijoufrench.index');
Route::get('/courses/{course}/songs', [SongsController::class, 'show'])->name('songs.show');
Route::get('/courses/{course}/activities', [ActivitiesController::class, 'show'])->name('activities.show');

Route::get('testHome', function () {
    return Inertia::render('testHome');
})->name('testHome');

Route::get('coursepage', function () {
    return Inertia::render('coursepage');
})->name('coursepage');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('dashboard');
    })->name('dashboard');
});

Route::get('/hello', function () {
    return 'Hello from VS Code! Everything is awesome!';
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
