<?php

namespace App\Http\Controllers;

use App\Http\Resources\CohortResource;
use App\Http\Resources\CourseResource;
use App\Models\Cohort;
use App\Models\Course;
use Illuminate\Http\Request;

class CohortController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $cohorts = Cohort::orderBy('order_column')->paginate();
        return CohortResource::collection($cohorts);
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

        ]);

        $maxOrderColumn = Cohort::max('order_column');
        $newOrderColumn = $maxOrderColumn + 1;

        $cohort = Cohort::create([
            'title' => $validated['title'],
            'order_column' => $newOrderColumn,
        ]);
        return new CohortResource($cohort);
    }

    /**
     * Display the specified resource.
     */
    public function show(Cohort $cohort)
    {
        //
        return new CohortResource($cohort);
    }

    public function showActiveCourse($cohort)
    {

        $courseId = "";

        $cohortById = Cohort::find($cohort);
        if ($cohortById && $cohortById->course) {
            $courseId = $cohortById->course->id;
        } else {
            $cohortBySlug = Cohort::where('slug', $cohort)->first();
            if ($cohortBySlug && $cohortBySlug->course) {
                $courseId = $cohortBySlug->course->id;
            }

        }

        if ($courseId) {
            $course = Course::find($courseId);
            $course->load("activities")->load("songs");

            return new CourseResource($course);
        }


        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cohort $cohort)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cohort $cohort)
    {
        //
        $validated = $request->validate([
            'title' => 'unique:cohorts|max:255',
            'active' => 'boolean',
            'order_column' => 'integer'
        ]);

        $cohort->update($validated);
        return new CohortResource($cohort);

    }

    public function move(Request $request, Cohort $cohort)
    {
        $validated = $request->validate([
            'direction' => 'required|in:up,down'
        ]);

        if ($validated['direction'] === 'down') {
            $cohort->moveOrderDown();
        } else {
            $cohort->moveOrderUp();
        }

        return new CohortResource($cohort);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cohort $cohort)
    {
        //
        $cohort->delete();
        return response()->noContent();

    }
}
