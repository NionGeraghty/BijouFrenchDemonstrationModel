<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

DB::statement('PRAGMA foreign_keys = OFF;'); // disable FK checks
\App\Models\Cohort::truncate();              // empty the table
DB::statement('PRAGMA foreign_keys = ON;');  // re-enable FK checks


class CohortsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('cohorts')->delete();

        \DB::table('cohorts')->insert(array (
            0 =>
            array (
                'id' => 1,
                'title' => 'Petit Bijou',
                'slug' => 'petitbijou',
                'image' => '/images/petit-bijou.png',
                'order_column' => 0,


                'created_at' => '2025-08-20 12:56:46',
                'updated_at' => '2025-08-20 12:56:46',
            ),
            1 =>
            array (
                'id' => 2,
                'title' => 'Mini Bijou',
                'slug' => 'minibijou',
                'image' => '/images/mini-bijou.png',
                'order_column' => 0,


                'created_at' => '2025-08-20 12:57:00',
                'updated_at' => '2025-08-20 12:57:00',
            ),
        ));


    }
}
