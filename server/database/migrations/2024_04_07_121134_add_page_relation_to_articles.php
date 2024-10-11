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
        // Alter the articles table to add a foreign key column
        Schema::table('articles', function (Blueprint $table) {
            // make the page_id column
            $table->foreignId('page_id')
                ->nullable()
                ->onDelete("set null")
                ->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         // Drop the foreign key column from the articles table
        Schema::table('articles', function (Blueprint $table) {
            $table->dropForeign(['page_id']);
            $table->dropColumn('page_id');
        });
    }
};
