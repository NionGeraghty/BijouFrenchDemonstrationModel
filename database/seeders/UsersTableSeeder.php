<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'michael',
                'email' => 'michael@boost.dev',
                'email_verified_at' => NULL,
                'password' => '$2y$12$LDPlu4trbmVgHmFdsU8dG.fcdgQi7cx1mbKIOx7Evc9uAdCLqg1MC',
                'remember_token' => NULL,
                'created_at' => '2025-08-20 11:35:43',
                'updated_at' => '2025-08-20 11:35:43',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'ross',
                'email' => 'ross@boost.dev',
                'email_verified_at' => NULL,
                'password' => '$2y$12$XQuSVe6o5mxfnSpx03KTdeCPYoxmmcRXlciPjBVDtmw80Fxk79dHi',
                'remember_token' => NULL,
                'created_at' => '2025-08-20 13:20:54',
                'updated_at' => '2025-08-20 13:20:54',
            ),
        ));
        
        
    }
}