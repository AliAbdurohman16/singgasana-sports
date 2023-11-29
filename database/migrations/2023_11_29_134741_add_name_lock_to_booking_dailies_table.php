<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('booking_dailies', function (Blueprint $table) {
            $table->string('student_counts')->after('duration')->nullable();
            $table->string('not_present')->after('student_counts')->nullable();
            $table->string('lock')->after('not_present')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('booking_dailies', function (Blueprint $table) {
            $table->dropColumn('student_counts');
            $table->dropColumn('not_present');
            $table->dropColumn('lock');
        });
    }
};
