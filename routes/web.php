<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\Cohort;

Route::get('/', function () {
    return Inertia::render('welcome');
})->name('home');

Route::prefix('courses')->name('courses.')->group(function () {

    // we never write this
    // $cohort = $database->query("SELECT * FROM cohorts WHERE id='2'");
    // if (!$cohort) {
    //     // throw an error
    // }
    
    
    // eloquent ORM
    // $cohort = Cohort::where("id", 2)->firstOrFail();

    // dd = die and dump
    // dd($cohorts);

    // we need to fetch our cohorts, provide only the relevent data to react, meaning title, slug, img
    // then update the page to use the data
    // then once /courses are working we can look at the individual courses + activity sheets
    //Learn what the hell a controller is


    Route::get('/', function () {
        $cohorts = Cohort::all();

        $courses = $cohorts->map(fn($cohort) =>[
            'title' => $cohort->title,
            'slug' => $cohort->slug,
            'imgSrc' => $cohort->image,
        ]
        );
        return Inertia::render('courses',[
            'courses'=> $courses,
        ]);
    })->name('index');

    Route::get('{course}/{page?}', function ($course, $page = null) {
    $cohort = Cohort::where('slug', $course)->firstOrFail();

    if (in_array($page, ['activitysheets', 'songs'])) {
        return Inertia::render('AuthPage', [
            'course' => $course,
            'page'   => $page,
        ]);
    }

    return Inertia::render($course, [
        'course' => $cohort,
    ]);
})->where('page', 'activitysheets|songs');

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
