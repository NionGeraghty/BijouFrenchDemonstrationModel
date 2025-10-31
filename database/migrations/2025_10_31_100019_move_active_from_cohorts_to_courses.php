<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Cohort;
use App\Models\Course;

return new class extends Migration
{
    public function up(): void
{
    Schema::table('cohorts', function (Blueprint $table) {
        $table->dropColumn('active');
    });

}


    public function down(): void
    {
        // Reverse the process
        Schema::table('cohorts', function (Blueprint $table) {
            $table->boolean('active')->default(false)->after('order_column');
        });

        Schema::table('courses', function (Blueprint $table) {
            $table->dropColumn('active');
        });
    }
};
