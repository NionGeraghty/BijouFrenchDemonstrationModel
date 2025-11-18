<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // SQLite does not support dropping columns simply.
        Schema::table('groups', function (Blueprint $table) {
            $table->dropForeign(['course_id']); // ignore if it doesn't exist
        });

        Schema::table('groups', function (Blueprint $table) {
            $table->dropColumn('course_id');
        });
    }

    public function down(): void
    {
        Schema::table('groups', function (Blueprint $table) {
            $table->unsignedBigInteger('course_id')->nullable();
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
        });
    }
};
