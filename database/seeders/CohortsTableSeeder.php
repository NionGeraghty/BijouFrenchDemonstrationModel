<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

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
                'slug' => 'petit-bijou',
                'image' => NULL,
                'order_column' => 0,
                'active' => 1,
                'created_at' => '2025-08-20 12:56:46',
                'updated_at' => '2025-08-20 12:56:46',
            ),
            1 => 
            array (
                'id' => 2,
                'title' => 'Mini Bijou',
                'slug' => 'mini-bijou',
                'image' => NULL,
                'order_column' => 0,
                'active' => 1,
                'created_at' => '2025-08-20 12:57:00',
                'updated_at' => '2025-08-20 12:57:00',
            ),
        ));
        
        
    }
}