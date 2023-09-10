<?php

namespace App\Http\Controllers;

use App\Http\Resources\CourseResource;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $courses = Course::with("activities")->with("songs")->paginate();
        return CourseResource::collection($courses);
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
            'title' => 'required|unique:courses|max:255',

        ]);

        $course = Course::create($validated);
        return new CourseResource($course);
    }

    /**
     * Display the specified resource.
     */
    public function show($course)
    {
        $courseById = Course::find($course);
        if ($courseById) {
            $courseById->load("activities")->load("songs");
            return new CourseResource($courseById);
        }

        $courseBySlug = Course::where('slug', $course)->first();
        if ($courseBySlug) {
            $courseBySlug->load("activities")->load("songs");
            return new CourseResource($courseBySlug);
        }

        abort(404);
    }

    /**
     * Display the specified resource by slug.
     */
    // public function showBySlug($slug)
    // {
    //     $course = Course::where('slug', $slug)->firstOrFail();
    //     return new CourseResource($course);
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        $input = $request->all();

        // Check if the cohort_id is being changed
        if (isset($input['cohort_id'])) {

            // Find other courses with the same cohort_id
            $otherCourses = Course::where('cohort_id', $input['cohort_id'])->get();

            // Clear the cohort_id on other courses
            foreach ($otherCourses as $otherCourse) {
                $otherCourse->update(['cohort_id' => null]);
            }
        }

        $course->fill($input)->save();
        return new CourseResource($course);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        //
        $course->delete();
        return response()->noContent();

    }
}
