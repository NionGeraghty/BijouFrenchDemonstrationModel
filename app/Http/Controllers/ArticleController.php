<?php

namespace App\Http\Controllers;

use App\Http\Resources\ArticleResource;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $articles = Article::paginate();
        return ArticleResource::collection($articles);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'title' => 'required|unique:articles|max:255',
            'text' => 'required',
        ]);

        $article = Article::create($validated);
        return new ArticleResource($article);
    }

    /**
     * Display the specified resource.
     */
    public function show($article)
    {
        // Try to find the article by ID
        $articleById = Article::find($article);

        if ($articleById) {
            return new ArticleResource($articleById);
        }

        // If an article with the given ID is not found, try to find by slug
        $articleBySlug = Article::where('slug', $article)->first();

        if ($articleBySlug) {
            return new ArticleResource($articleBySlug);
        }

        // Handle the case where neither ID nor slug match
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        //
        $validated = $request->validate([
            'title' => 'unique:articles|max:255',
            'text' => '',
        ]);

        $article->update($validated);
        return new ArticleResource($article);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        //
        $article->delete();
        return response()->noContent();
    }
}
