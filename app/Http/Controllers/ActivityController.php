<?php

namespace App\Http\Controllers;

use App\Http\Resources\ActivityResource;
use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $activities = Activity::paginate();
        return ActivityResource::collection($activities);
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

        $maxOrderColumn = Activity::max('order_column');
        $newOrderColumn = $maxOrderColumn + 1;

        $activity = Activity::create([
            'title' => $validated['title'],
            'order_column' => $newOrderColumn,
            'course_id' => $validated['course_id'],
        ]);

        return new ActivityResource($activity);
    }

    /**
     * Display the specified resource.
     */
    public function show(Activity $activity)
    {
        //
        return new ActivityResource($activity);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Activity $activity)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Activity $activity)
    {
        //
        $validated = $request->validate([
            'title' => 'unique:cohorts|max:255',
            "course_id" => "exists:courses,id",
            "order_column" => "integer"
        ]);

        $activity->update($validated);
        return new ActivityResource($activity);
    }

    public function downloadWorksheet(Activity $activity) {
        return response()->download(storage_path("app/public/" . $activity->worksheet), $activity->worksheet_name);
    }

    public function downloadAnswers(Activity $activity) {
        return response()->download(storage_path("app/public/" . $activity->answers), $activity->answers_name);
    }

    public function uploadWorksheet(Request $request, Activity $activity) {
        $request->validate([
            'worksheet' => 'required|mimes:docx',
        ]);

        $file = $request->file('worksheet');
        if($file->storeAs('public/files', $file->getClientOriginalName())) {
            $activity->worksheet = $file->getClientOriginalName();
            $activity->save();
            return response()->json([
                'message' => 'Worksheet uploaded successfully'
            ]);
        } else {
            return response()->json([
                'message' => 'Error uploading worksheet'
            ]);
        }
    }

    public function uploadAnswers(Request $request, Activity $activity) {
        $request->validate([
            'answers' => 'required|mimes:docx',
        ]);

        $file = $request->file('answers');
        if($file->storeAs('public/files', $file->getClientOriginalName())) {
            $activity->answers = $file->getClientOriginalName();
            $activity->save();
            return response()->json([
                'message' => 'Answers uploaded successfully'
            ]);
        } else {
            return response()->json([
                'message' => 'Error uploading answers'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Activity $activity)
    {
        //
        $activity->delete();
        return response()->noContent();
    }
}
