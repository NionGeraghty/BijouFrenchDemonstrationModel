<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Cohort;

class ActivitiesController extends Controller
{
    public function show($cohort){
        $cohort = Cohort::with([
            'activeCourse' => function ($query) {
                $query->select('id', 'title', 'access_code', 'cohort_id');
            }
        ])->where('slug', $slug)->firstOrFail();

        return Inertia::render('activities',[
            'cohort' => $cohort,
        ]);
    }
}
