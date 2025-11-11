<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {


        $this->call(UsersTableSeeder::class);
        $this->call(PagesTableSeeder::class);
        $this->call(ArticlesTableSeeder::class);
        $this->call(CoursesTableSeeder::class);
        $this->call(GroupsTableSeeder::class);
        $this->call(ActivitiesTableSeeder::class);
        $this->call(SongsTableSeeder::class);
    }
}
