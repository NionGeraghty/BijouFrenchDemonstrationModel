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
        // add a page table with slug and article fields
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('slug')->unique();
            $table->foreignId('article_id')
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


        // drop the page table
        Schema::dropIfExists('pages');
    }
};
