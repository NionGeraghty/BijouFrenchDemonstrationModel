<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Group;
use App\Models\Course;
use App\Models\Song;
use App\Models\Activity;
use App\Models\Article;

class CourseController extends Controller
{
    public function index(){
        $groups = Group::with(['activeCourse'])->get();

        return Inertia::render('courses',[
            'groups'=> $groups,
        ]);
    }

    public function show($group, $page = null)
    {
        $group = Group::with(['activeCourse'])->where('slug', $group)->firstOrFail();
        $courses = Course::all();
        $songs = Song::all();
        $activities = Activity::all();
        $articles = Article::all();

        if (in_array($page, ['activitysheets', 'songs'])) {
            return Inertia::render('AuthPage', [
                'group'  => $group,
                'page'    => $page,
                'courses' => $courses,
                'songs'   => $songs,
                'activities' => $activities,
            ]);
        }

        return Inertia::render('coursepage', [
            'group' => $group,
            'articles' => $articles,
        ]);
    }
}
