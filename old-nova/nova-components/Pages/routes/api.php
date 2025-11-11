<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Page;
use App\Models\Article;

/*
|--------------------------------------------------------------------------
| Tool API Routes
|--------------------------------------------------------------------------
|
| Here is where you may register API routes for your tool. These routes
| are loaded by the ServiceProvider of your tool. They are protected
| by your tool's "Authorize" middleware by default. Now, go build!
|
*/

Route::get('/', function (Request $request) {
    // return all pages
    $pages = Page::all();
    return $pages;

    // // return the about-bijou-french page
    // $page = Page::where('slug', 'about-bijou-french')->first();
    // return $page;

});

Route::get('/articles', function (Request $request) {
    // return all articles
    $articles = Article::all();
    return $articles;
});

// update the article id
Route::put('/{slug}', function (Request $request, $slug) {
    // grab the page by slug
    $page = Page::where('slug', $slug)->first();
    if (!$page) {
        return response()->json(['error' => 'Page not found'], 404);
    }


    // grab the article id from the request
    $articleId = $request->input('article_id');

    // return $request;
    // return $articleId;

    // it must exist as an article
    $article = Article::find($articleId);
    if (!$article) {
        return response()->json(['error' => 'Article not found'], 404);
    }

    // update the page with the new article id
    $page->article_id = $articleId;
    $page->save();

    return $page;
});
