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
        Schema::create('booking_dailies', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('email');
            $table->string('telephone');
            $table->string('service');
            $table->datetime('datetime');
            $table->string('duration')->nullable();
            $table->datetime('expired');
            $table->decimal('total', 15, 2);
            $table->string('pin')->nullable();
            $table->string('qr')->nullable();
            $table->enum('status', ['pending', 'success', 'expired'])->nullable()->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('booking_dailies');
    }
};
