<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ActivitiesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('activities')->delete();
        
        \DB::table('activities')->insert(array (
            0 => 
            array (
                'id' => 1,
                'title' => 'Activity One',
                'order_column' => 0,
                'worksheet' => 'activities/worksheets/01K7P4KDCCF7NR69NY9NXRT3TC.docx',
                'answers' => 'activities/answers/01K7P4KDCD5HX7AN52C43BVCJJ.docx',
                'worksheet_name' => NULL,
                'answers_name' => NULL,
                'course_id' => 1,
                'created_at' => '2025-10-16 09:11:17',
                'updated_at' => '2025-10-16 09:11:17',
            ),
        ));
        
        
    }
}