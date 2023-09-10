<?php

namespace App\Http\Controllers;

use App\Http\Resources\SongResource;
use App\Models\Song;
use Illuminate\Http\Request;

class SongController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $songs = Song::paginate();
        return SongResource::collection($songs);
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
            'title' => 'required|unique:cohorts|max:255',
            "course_id" => "exists:courses,id",

        ]);

        $maxOrderColumn = Song::max('order_column');
        $newOrderColumn = $maxOrderColumn + 1;

        $song = Song::create([
            'title' => $validated['title'],
            'order_column' => $newOrderColumn,
            'course_id' => $validated['course_id'],
        ]);

        return new SongResource($song);
    }

    /**
     * Display the specified resource.
     */
    public function show(Song $song)
    {
        //
        return new SongResource($song);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Song $song)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Song $song)
    {
        //
        $validated = $request->validate([
            'title' => 'required|unique:cohorts|max:255',
            "course_id" => "exists:courses,id",

        ]);

        $song->update($validated);
        return new SongResource($song);
    }

    public function uploadMp3(Request $request, Song $song)
    {
        $validated = $request->validate([
            'mp3' => 'required|mimes:mp3,wav|max:100000',
        ]);

        $file = $request->file('mp3');
        if ($file->storeAs('public/files', $file->getClientOriginalName())) {
            $song->mp3 = $file->getClientOriginalName();
            $song->save();
            return new SongResource($song);
        } else {
            return response()->json(['error' => 'Could not upload file'], 500);
        }
    }

    public function uploadLyrics(Request $request, Song $song)
    {
        $validated = $request->validate([
            'lyrics' => 'required|mimes:docx|max:100000',
        ]);

        $file = $request->file('lyrics');

        if ($file->storeAs('public/files', $file->getClientOriginalName())) {
            $song->lyrics = $file->getClientOriginalName();
            $song->save();
            return new SongResource($song);
        } else {
            return response()->json(['error' => 'Could not upload file'], 500);
        }


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Song $song)
    {
        //
        $song->delete();
        return response()->noContent();


    }
}
