<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Cohort;
use App\Models\Article;

class CoursePageController extends Controller
{
    public function show($cohort){
        $cohort = Cohort::where('slug', $cohort)->firstOrFail();
        $article = Article::where('slug', $cohort->slug)->firstOrFail();

        return Inertia::render('coursepage',[
            'cohort' => $cohort,
            'article' => $article,
        ]);
    }
}
