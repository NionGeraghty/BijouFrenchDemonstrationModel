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
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->integer('order_column');
            $table->string('worksheet')->nullable();
            $table->string('answers')->nullable();
            $table->string('worksheet_name')->nullable();
            $table->string('answers_name')->nullable();
            $table->foreignId('course_id')
                ->nullable()
                ->onDelete('set null')
                ->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activities');
    }
};
