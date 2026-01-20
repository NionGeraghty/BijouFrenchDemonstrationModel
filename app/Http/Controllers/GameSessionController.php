<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GameSession;

class GameSessionController extends Controller
{
        public function store(Request $request)
        {
            $session = GameSession::create($request->only('name', 'start_time', 'game_times'));
            return response()->json(['id' => $session->id]);
        }

}
