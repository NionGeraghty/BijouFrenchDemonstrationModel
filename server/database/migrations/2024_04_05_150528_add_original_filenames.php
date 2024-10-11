<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // add _name fields for worksheets and answers
        Schema::table('activities', function (Blueprint $table) {
            $table->string('worksheet_name')->nullable();
            $table->string('answers_name')->nullable();
        });

        // add _name fields for song lyrics and mp3
        Schema::table('songs', function (Blueprint $table) {
            $table->string('lyrics_name')->nullable();
            $table->string('mp3_name')->nullable();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // drop _name fields
        Schema::table('activities', function (Blueprint $table) {
            $table->dropColumn('worksheet_name');
            $table->dropColumn('answers_name');
        });

        Schema::table('songs', function (Blueprint $table) {
            $table->dropColumn('lyrics_name');
            $table->dropColumn('mp3_name');
        });
    }
};
