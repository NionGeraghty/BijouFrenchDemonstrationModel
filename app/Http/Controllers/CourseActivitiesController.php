<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Course;
use App\Models\Cohort;


class CourseActivitiesController extends Controller
{
    public function show(Cohort $cohort) {
        $course = $cohort->activeCourse;

        // dd($course);

        $activities = $course->activities()->get();

        // dd($activities->get());



        //$activities = [
        //    ["title" => "Activity 1", "worksheet" => "worksheet-1.docx", "answers" => "answers-1.docx"],
        //    ["title" => "Activity 2", "worksheet" => "worksheet-2.docx", "answers" => "answers-2.docx"],
        //    ["title" => "Activity 3", "worksheet" => "worksheet-3.docx", "answers" => "answers-3.docx"],
        //];




        return Inertia::render("activities", [
            'activities' => $activities,
            'cohort' => $cohort,
        ]);
    }
}
