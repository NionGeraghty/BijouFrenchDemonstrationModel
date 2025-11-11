<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CohortController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\SongController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::post('/token', [AuthController::class, 'generateToken']);

// Public routes (no authentication required)
Route::get('articles', [ArticleController::class, 'index']);
Route::get('articles/{article}', [ArticleController::class, 'show']);

Route::get('activities', [ActivityController::class, 'index']);
Route::get('activities/{activity}', [ActivityController::class, 'show']);
Route::get('activities/{activity}/worksheet', [ActivityController::class, 'downloadWorksheet']);
Route::get('activities/{activity}/answers', [ActivityController::class, 'downloadAnswers']);

Route::get('songs', [SongController::class, 'index']);
Route::get('songs/{song}', [SongController::class, 'show']);
Route::get('songs/{song}/mp3', [SongController::class, 'downloadMp3']);
Route::get('songs/{song}/lyrics', [SongController::class, 'downloadLyrics']);

Route::get('courses', [CourseController::class, 'index']);
// Route::get('courses/{slug}', [CourseController::class, 'showBySlug']);
Route::get('courses/{course}', [CourseController::class, 'show']);

Route::post('courses/{slug}/game-attempt', [CourseController::class, 'logGameAttempt']);

Route::get('cohorts', [CohortController::class, 'index']);
Route::get('cohorts/{cohort}', [CohortController::class, 'show']);
Route::get('cohorts/{cohort}/course', [CohortController::class, 'showActiveCourse']);

// Protected routes (require authentication)
// Route::middleware('auth:sanctum')->group(function () {
//     Route::resource('articles', ArticleController::class)
//     ->except(['index', 'show']);

//     Route::resource('activities', ActivityController::class)
//         ->except(['index', 'show']);
//     Route::post('activities/{activity}/worksheet', [ActivityController::class, 'uploadWorksheet']);
//     Route::post('activities/{activity}/answers', [ActivityController::class, 'uploadAnswers']);


//     Route::resource('songs', SongController::class)
//     ->except(['index', 'show']);
//     Route::post('songs/{song}/mp3', [SongController::class, 'uploadMp3']);
//     Route::post('songs/{song}/lyrics', [SongController::class, 'uploadLyrics']);

//     Route::resource('courses', CourseController::class)
//         ->except(['index', 'show']);

//     Route::resource('cohorts', CohortController::class)
//         ->except(['index', 'show']);

//     Route::patch('cohorts/{cohort}/move', [CohortController::class, 'move']);
// });
