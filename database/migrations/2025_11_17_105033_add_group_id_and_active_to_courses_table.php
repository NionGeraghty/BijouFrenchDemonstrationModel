<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('courses', function (Blueprint $table) {

            if (!Schema::hasColumn('courses', 'group_id')) {
                $table->foreignId('group_id')->nullable()->constrained()->cascadeOnDelete();
            }

            if (!Schema::hasColumn('courses', 'active')) {
                $table->boolean('active')->default(false);
            }
        });
    }

    public function down(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            if (Schema::hasColumn('courses', 'group_id')) {
                $table->dropForeign(['group_id']);
                $table->dropColumn('group_id');
            }

            if (Schema::hasColumn('courses', 'active')) {
                $table->dropColumn('active');
            }
        });
    }
};
