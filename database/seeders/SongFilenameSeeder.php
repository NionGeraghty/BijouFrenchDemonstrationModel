<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Song;
use Illuminate\Support\Str;

class SongFilenameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $songs = Song::all();

        // Loop through each song and populate mp3_name and lyrics_name columns
        foreach ($songs as $song) {
            $title = Str::slug($song->title);
            $song->mp3_name = $title . '.mp3';
            $song->lyrics_name = $title . '.docx';
            $song->save();
        }
    }
}
