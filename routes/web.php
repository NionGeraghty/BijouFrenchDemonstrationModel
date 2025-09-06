<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('welcome');
})->name('home');

Route::prefix('courses')->name('courses.')->group(function () {
    Route::get('/', fn () => Inertia::render('courses'))->name('index');

    Route::get('{course}/{page?}', function ($course, $page = null) {
        if (in_array($course, ['minibijou', 'petitbijou'])) {
            if (in_array($page, ['activitysheets', 'songs'])) {
                return Inertia::render('AuthPage', [
                    'course' => $course,
                    'page'   => $page,
                ]);
            }

            return Inertia::render($course);
        }

        abort(404);
    })->where('course', 'minibijou|petitbijou')
      ->where('page', 'activitysheets|songs');
});


Route::get('aboutbijoufrench', function () {
    return Inertia::render('aboutbijoufrench');
})->name('aboutbijoufrench');

Route::get('aboutsue', function () {
    return Inertia::render('aboutsue');
})->name('aboutsue');

Route::get('testHome', function () {
    return Inertia::render('testHome');
})->name('testHome');

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
