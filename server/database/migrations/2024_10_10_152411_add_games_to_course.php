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
        Schema::table('courses', function (Blueprint $table) {
            // add reorder games json field
            $table->json('reorder_games')->nullable();
            $table->json('odd_one_out_games')->nullable();
            $table->json('category_games')->nullable();


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            // drops
            $table->dropColumn('reorder_games');
            $table->dropColumn('odd_one_out_games');
            $table->dropColumn('category_games');
        });
    }
};
