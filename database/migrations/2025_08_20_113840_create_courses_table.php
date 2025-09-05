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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('access_code')->nullable();
            $table->foreignId('article_id')
                ->nullable()
                ->onDelete('set null')
                ->constrained();
            $table->foreignId('cohort_id')
                ->nullable()
                ->onDelete('set null')
                ->constrained();
            $table->json('reorder_games')->nullable();
            $table->json('odd_one_out_games')->nullable();
            $table->json('category_games')->nullable();
            $table->json('match_up_games')->nullable();
            $table->boolean('games_active')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
