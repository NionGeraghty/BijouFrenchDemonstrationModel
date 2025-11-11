<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $pages = Page::paginate();
        return $pages;
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
            'slug' => 'required|unique:pages|max:255',
            'article_id' => 'exists:articles,id',
        ]);

        $page = Page::create($validated);
        return $page;
    }

    /**
     * Display the specified resource.
     */
    public function show(Page $page)
    {
        // find the page by slug
        $pageBySlug = Page::where('slug', $page)->first();

        if ($pageBySlug) {
            return $pageBySlug;
        }

        abort(404, 'Page not found');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Page $page)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Page $page)
    {
        // get page by slug
        $pageBySlug = Page::where('slug', $page)->first();

        // 404 if page not found
        if (!$pageBySlug) {
            abort(404, 'Page not found');
        }

        $validated = $request->validate([
            'slug' => 'required|unique:pages|max:255',
            'article_id' => 'exists:articles,id',
        ]);

        $pageBySlug->update($validated);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Page $page)
    {
        //
    }
}
