<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Article;

class AboutSueController extends Controller
{
    public function index(){
        $articles = Article::all();

        return Inertia::render('aboutsue',[
            'articles'=> $articles,
        ]);
    }
} 
