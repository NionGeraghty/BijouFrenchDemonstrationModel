<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Course;
use App\Models\Group;


class CourseActivitiesController extends Controller
{
    public function show(Group $group)
    {
        $group->load('activeCourse');

        $course = $group->activeCourse;

        if (!$course) {
            abort(404, 'No course assigned to this group.');
        }

        return Inertia::render('activities', [
            'group' => $group,
            'activities' => $course->activities()->get(),
        ]);
    }

}
