<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\Cohort;
use App\Http\Controllers\CourseController;

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

Route::prefix('courses')->name('courses.')->group(function () {
    
    Route::get('/', [CourseController::class, 'index'])->name('index');

    Route::get('{course}/{page?}', [CourseController::class, 'show'])
        ->where('page', 'activitysheets|songs')
        ->name('show');
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

/*Route::get('coursepage', function () {
    return Inertia::render('coursepage');
})->name('coursepage');*/

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
