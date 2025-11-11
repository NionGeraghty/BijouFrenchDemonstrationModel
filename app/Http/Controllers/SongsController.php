<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Group;

class SongsController extends Controller
{
    public function show($group){
        $group = Group::with(['course'])->where('slug', $group)->firstOrFail();

        return Inertia::render('songs',[
            'group' => $group,
        ]);
    }
}
