<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GameSessionController extends Controller
{
        public function store(Request $request)
    {
        $session = GameSession::create([
            'name' => $request->name,
            'start_time' => $request->start_time,
            'game_times' => $request->game_times ?? [],
            'course_id' => $request->course_id,
        ]);

        return response()->json(['id' => $session->id]);
    }

}
