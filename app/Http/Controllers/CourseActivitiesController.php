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
        return Inertia::render('activities', [
            'group' => $group,
            'activities' => $group->course->activities,
        ]);
    }

}
