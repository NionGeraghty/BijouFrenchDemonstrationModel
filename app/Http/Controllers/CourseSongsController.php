<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Course;
use App\Models\Cohort;

class CourseSongsController extends Controller
{
    public function show(Cohort $cohort) {
        $cohort->load('activeCourse');
        $course = $cohort->activeCourse;

        if (!$course) {
            abort(404, 'No active course found for this cohort.');
        }

        $songs = $course->songs()->get();

        return Inertia::render("songs", [
            'songslist' => $songs,
            'cohort' => $cohort,
        ]);
    }
}
