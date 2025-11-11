<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::table('cohorts', function (Blueprint $table) {
        if (Schema::hasColumn('cohorts', 'course_id')) {
            $table->dropForeign(['course_id']);
            $table->dropColumn('course_id');
        }
    });

    Schema::table('courses', function (Blueprint $table) {
        if (!Schema::hasColumn('courses', 'cohort_id')) {

            $table->foreignId('cohort_id')->nullable()->constrained()->onDelete('cascade');
        }
    });
}

public function down()
{
    Schema::table('courses', function (Blueprint $table) {
        if (Schema::hasColumn('courses', 'cohort_id')) {
            $table->dropForeign(['cohort_id']);
            $table->dropColumn('cohort_id');
        }
    });

    Schema::table('cohorts', function (Blueprint $table) {
        if (!Schema::hasColumn('cohorts', 'course_id')) {
            $table->foreignId('course_id')->nullable()->constrained()->onDelete('cascade');
        }
    });
}

};
