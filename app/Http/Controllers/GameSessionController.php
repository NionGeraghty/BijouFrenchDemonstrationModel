<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GameSession;
use Illuminate\Support\Facades\Log;

class GameSessionController extends Controller
{
        public function store(Request $request)
        {
            Log::info($request->only('name', 'startTime', 'gameTimes'));

            $validated = $request->validate([
                'name' => 'required|string|max:256',
                'startTime' => 'required|integer',
                'gameTimes' => 'array',
                'gameTimes.*' => 'integer',
            ]);


            $session = GameSession::create([
                "name" => $request["name"],
                "start_time" => $request["startTime"],
                "game_times" => $request["gameTimes"]
            ]
                
            );
            return response()->json(['id' => $session->id]);
        }

}
