<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\Group;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\AboutSueController;
use App\Http\Controllers\AboutBijouFrenchController;
use App\Http\Controllers\CoursePageController;
use App\Http\Controllers\CourseActivitiesController;
use App\Http\Controllers\CourseSongsController;
use App\Http\Controllers\CourseGamesController;

Route::get('/', function () {
    $groups = Group::with('course')->get();

    $courses = $groups->map(fn($group) => [
        'title' => $group->title,
        'slug' => $group->slug,
        'active_course' => $group->course?->title, // optional
    ]);

    return Inertia::render('welcome', [
        'courses' => $courses,
    ]);
})->name('home');




//Route::get('/courses/{course}/{page?}', [CourseController::class, 'show'])
//    ->where('page', 'activitysheets|songs')
//    ->name('courses.show');

Route::get('/aboutsue', [AboutSueController::class, 'index'])->name('aboutsue.index');
Route::get('/aboutbijoufrench', [AboutBijouFrenchController::class, 'index'])->name('aboutbijoufrench.index');


Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');

Route::get('/courses/{group:slug}', [CoursePageController::class, 'show'])->name('coursepage.show');

// guarded
Route::get('/courses/{group:slug}/activities', [CourseActivitiesController::class, 'show'])->name('activities.show');
Route::get('/courses/{group:slug}/songs', [CourseSongsController::class, 'show'])->name('songs.show');
Route::get('/courses/{group:slug}/games', [CourseGamesController::class, 'show'])->name('games.show');



Route::get('testHome', function () {
    return Inertia::render('testHome');
})->name('testHome');

//Route::get('coursepage', function () {
//    return Inertia::render('coursepage');
//})->name('coursepage');

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
