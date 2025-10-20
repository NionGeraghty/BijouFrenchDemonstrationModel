<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Cohort;

class CourseController extends Controller
{
    public function show($slug) {

        $cohort = Cohort::where('slug' , $slug)->firstOrFail();

        $courses = $cohort->courses();


        dd($courses);

        return Inertia::render('course', [
          "course" => $course,
        ]);
    }
}
