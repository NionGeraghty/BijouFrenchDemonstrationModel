<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Cohort;

class ActivitiesController extends Controller
{
    public function show($cohort){
        $cohort = Cohort::where('slug', $cohort)->firstOrFail();

        return Inertia::render('activities',[
            'cohort' => $cohort,
        ]);
    }
}
