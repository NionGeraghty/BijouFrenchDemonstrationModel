<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('welcome');
})->name('home');

Route::prefix('courses')->name('courses.')->group(function () {
    Route::get('/', function () {
        return Inertia::render('courses');
    })->name('index');

    Route::get('/minibijou', function () {
        return Inertia::render('minibijou');
    })->name('minibijou');

    Route::get('/petitbijou', function () {
        return Inertia::render('petitbijou');
    })->name('petitbijou');
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
