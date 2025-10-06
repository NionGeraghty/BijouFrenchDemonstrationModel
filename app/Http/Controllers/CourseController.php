<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Cohort;
use App\Models\Course;

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

        if (in_array($page, ['activitysheets', 'songs'])) {
            return Inertia::render('AuthPage', [
                'cohort'  => $cohort,
                'page'    => $page,
                'courses' => $courses,
            ]);
        }

        return Inertia::render('coursepage', [
            'course' => $cohort,
        ]);
    }
}
