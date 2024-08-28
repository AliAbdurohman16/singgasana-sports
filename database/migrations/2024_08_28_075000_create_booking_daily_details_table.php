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
        Schema::create('booking_daily_details', function (Blueprint $table) {
            $table->id();
            $table->string('booking_id');
            $table->string('duration');
            $table->string('kategori');
            $table->string('roomy')->nullable();
            $table->string('qty');
            $table->decimal('amount_price_swimming', 15, 2)->nullable();
            $table->timestamps();
            $table->foreign('booking_id')->references('id')->on('booking_dailies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('booking_daily_details');
    }
};
