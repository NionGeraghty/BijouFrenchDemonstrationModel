<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Group;
use App\Models\Article;

class CoursePageController extends Controller
{
    public function show($group){

        $group = Group::with(['course'])->where('slug', $group)->firstOrFail();
        $article = Article::where('slug', $group->slug)->firstOrFail();

        return Inertia::render('coursepage',[
            'group' => $group,
            'article' => $article,
        ]);
    }
}
