<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CoursesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('courses')->delete();

        \DB::table('courses')->insert(array (
            0 =>
            array (
                'id' => 1,
                'title' => 'Petit Bijou Autumn 2025',
                'access_code' => 'sympa',
                'article_id' => 1,
                'reorder_games' => '[]',
                'odd_one_out_games' => '[]',
                'category_games' => '[]',
                'match_up_games' => '[]',
                'games_active' => 0,
                'created_at' => '2025-08-20 13:15:23',
                'updated_at' => '2025-08-20 13:16:42',
            ),

            1 =>
            array (
                'id' => 2,
                'title' => 'Mini Bijou Autumn 2025',
                'access_code' => 'pomme',
                'article_id' => 1,
                'reorder_games' => '[]',
                'odd_one_out_games' => '[]',
                'category_games' => '[]',
                'match_up_games' => '[]',
                'games_active' => 0,
                'created_at' => '2025-08-20 13:15:23',
                'updated_at' => '2025-08-20 13:16:42',
            ),

            2 =>
            array (
                'id' => 3,
                'title' => 'Mini Bijou Spring 2025',
                'access_code' => 'souris',
                'article_id' => 1,
                'reorder_games' => '[]',
                'odd_one_out_games' => '[]',
                'category_games' => '[]',
                'match_up_games' => '[]',
                'games_active' => 0,
                'created_at' => '2025-08-20 13:15:23',
                'updated_at' => '2025-08-20 13:16:42',
            ),
        ));


    }
}
