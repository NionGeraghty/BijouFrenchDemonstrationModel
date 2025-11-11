<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Group;
use App\Models\Article;

class CoursePageController extends Controller
{
    public function show(string $slug){


        $group = Group::with(['course'])->where('slug', $slug)->firstOrFail();

        $article = $group->course->article;

        return Inertia::render('coursepage',[
            'group' => $group,
            'article' => $article,
        ]);
    }
}
