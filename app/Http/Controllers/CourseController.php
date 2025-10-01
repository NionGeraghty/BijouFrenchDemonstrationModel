<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Cohort;

class CourseController extends Controller
{
    public function index(){
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
    }

    public function show($course, $page = null)
    {
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
    }
}
