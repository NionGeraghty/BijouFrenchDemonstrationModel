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
    Schema::create('game_sessions', function (Blueprint $table) {
        $table->id();
        $table->string('name'); // the student's name
        $table->bigInteger('start_time'); // store Date.now() from JS
        $table->json('game_times')->nullable(); // array of ms per game
        $table->foreignId('course_id')->nullable()->constrained(); // link to a course if needed
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('game_sessions');
    }
};
