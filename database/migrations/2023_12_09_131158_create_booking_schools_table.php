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
    public function up()
    {
        Schema::create('booking_schools', function (Blueprint $table) {
            $table->id();
            $table->string('booking_member_id');
            $table->datetime('start_date');
            $table->string('student_counts')->nullable();
            $table->string('not_present')->nullable();
            $table->string('lock')->nullable();
            $table->decimal('subtotal', 15, 2);
            $table->decimal('ppn', 15, 2);
            $table->decimal('total', 15, 2);
            $table->timestamps();
            $table->foreign('booking_member_id')->references('id')->on('booking_members')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('booking_schools');
    }
};
