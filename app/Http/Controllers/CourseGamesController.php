<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Group;

class CourseGamesController extends Controller
{
    public function show(Group $group)
    {
        $group->load('course');
        $course = $group->course;

        if (!$course) {
            abort(404, 'No course assigned to this group.');
        }

        // Get games data - the model accessors will handle the transformation
        $gamesData = [
            'reorder_games' => json_decode($course->getAttributes()['reorder_games'] ?? '[]', true),
            'odd_one_out_games' => json_decode($course->getAttributes()['odd_one_out_games'] ?? '[]', true),
            'category_games' => json_decode($course->getAttributes()['category_games'] ?? '[]', true),
            'match_up_games' => json_decode($course->getAttributes()['match_up_games'] ?? '[]', true),
            'games_active' => $course->games_active,
        ];

        return Inertia::render('games', [
            'group' => $group,
            'gamesData' => $gamesData,
        ]);
    }
}

