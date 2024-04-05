<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Activity;

class TitleToFilenameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Retrieve all activities
        $activities = Activity::all();

        // Loop through each activity and populate worksheet_name and answers_name columns
        foreach ($activities as $activity) {
            $title = $activity->title;
            $activity->worksheet_name = $title . '.docx';
            $activity->answers_name = $title . '_answers.docx';
            $activity->save();
        }
    }
}
