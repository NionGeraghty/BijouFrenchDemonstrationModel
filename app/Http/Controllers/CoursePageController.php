<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Group;
use App\Models\Article;

class CoursePageController extends Controller
{
    public function show(string $slug){


        $group = Group::with(['activeCourse'])->where('slug', $slug)->firstOrFail();

        $article = Article::where('slug', $slug)->firstOrFail();

        return Inertia::render('coursepage',[
            'group' => $group,
            'article' => $article,
        ]);
    }
}
