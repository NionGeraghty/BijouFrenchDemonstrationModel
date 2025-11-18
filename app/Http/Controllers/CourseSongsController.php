<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Course;
use App\Models\Group;

class CourseSongsController extends Controller
{
    public function show(Group $group) {
        $group->load('course');
        $course = $group->course;

        if (!$course) {
            abort(404, 'No course assigned to this group.');
        }

        $songs = $course->songs()->get();

        return Inertia::render("songs", [
            'songslist' => $songs,
            'group' => $group,
        ]);
    }
}
