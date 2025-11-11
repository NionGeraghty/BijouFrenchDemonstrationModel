<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;

class GamesTableSeeder extends Seeder
{
    /**
     * Seed sample game data for courses
     *
     * @return void
     */
    public function run()
    {
        // Get the first course
        $course = Course::first();

        if (!$course) {
            $this->command->info('No courses found. Please seed courses first.');
            return;
        }

        // Sample Reorder Games
        $reorderGames = [
            [
                'question' => 'trois deux un',
                'solution' => 'un deux trois',
                'hint' => 'Count from 1 to 3'
            ],
            [
                'question' => 'suis Je fatigué',
                'solution' => 'Je suis fatigué',
                'hint' => 'Subject-verb-adjective order'
            ],
            [
                'question' => 'Bijou m\'appelle Je',
                'solution' => 'Je m\'appelle Bijou',
                'hint' => 'How to introduce yourself'
            ],
        ];

        // Sample Odd One Out Games
        $oddOneOutGames = [
            [
                'question' => "un\ndeux\npomme\nquatre",
                'solution' => 'pomme',
                'hint' => 'Which one is not a number?'
            ],
            [
                'question' => "Orange\nBoeuf\nPomme\nAnanas",
                'solution' => 'Boeuf',
                'hint' => 'Which one is not a fruit?'
            ],
            [
                'question' => "rouge\nvert\nchien\nbleu",
                'solution' => 'chien',
                'hint' => 'Which one is not a color?'
            ],
        ];

        // Sample Category Games
        $categoryGames = [
            [
                'game' => "orange:Colours\nrouge:Colours\nsept:Numbers\nla jambe:Parts of the body\ndix:Numbers\nsalut:Greetings\njaune:Colours\nau revoir:Greetings\nles yeux:Parts of the body",
                'hint' => 'Sort by category'
            ],
            [
                'game' => "chat:Animals\nchien:Animals\ntable:Furniture\nchaise:Furniture\npain:Food\nfromage:Food\nlit:Furniture",
                'hint' => 'Group the words'
            ],
        ];

        // Sample Match Up Games
        $matchUpGames = [
            [
                'game' => "Bonjour:Hello\nMerci:Thank you\nAu revoir:Goodbye\nS'il vous plaît:Please\nOui:Yes\nNon:No",
                'hint' => 'Match French to English'
            ],
            [
                'game' => "un:one\ndeux:two\ntrois:three\nquatre:four\ncinq:five",
                'hint' => 'Match numbers'
            ],
        ];

        // Update the course with game data
        $course->update([
            'reorder_games' => $reorderGames,
            'odd_one_out_games' => $oddOneOutGames,
            'category_games' => $categoryGames,
            'match_up_games' => $matchUpGames,
            'games_active' => true,
        ]);

        $this->command->info('Game data seeded successfully for course: ' . $course->title);

        // Optionally seed for other courses
        $secondCourse = Course::skip(1)->first();
        if ($secondCourse) {
            $secondCourse->update([
                'reorder_games' => [
                    [
                        'question' => 'petit suis Je',
                        'solution' => 'Je suis petit',
                        'hint' => 'I am small'
                    ],
                ],
                'odd_one_out_games' => [
                    [
                        'question' => "lundi\nmardi\nsouris\njeudi",
                        'solution' => 'souris',
                        'hint' => 'Which one is not a day?'
                    ],
                ],
                'category_games' => [],
                'match_up_games' => [],
                'games_active' => true,
            ]);

            $this->command->info('Game data seeded successfully for course: ' . $secondCourse->title);
        }
    }
}

