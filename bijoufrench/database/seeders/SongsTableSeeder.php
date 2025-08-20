<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SongsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('songs')->delete();
        
        
        
    }
}