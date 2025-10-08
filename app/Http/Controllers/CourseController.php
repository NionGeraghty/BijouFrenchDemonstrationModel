<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Cohort;
use App\Models\Course;
use App\Models\Song;
use App\Models\Activity;

class CourseController extends Controller
{
    public function index(){
        $cohorts = Cohort::all();

        return Inertia::render('courses',[
            'courses'=> $cohorts,
        ]);
    }

    public function show($cohort, $page = null)
    {
        $cohort = Cohort::where('slug', $cohort)->firstOrFail();
        $courses = Course::all();
        $songs = Song::all();
        $activities = Activity::all();

        if (in_array($page, ['activitysheets', 'songs'])) {
            return Inertia::render('AuthPage', [
                'cohort'  => $cohort,
                'page'    => $page,
                'courses' => $courses,
                'songs'   => $songs,
                'activities' => $activities,
            ]);
        }

        return Inertia::render('coursepage', [
            'course' => $cohort,
        ]);
    }
}
