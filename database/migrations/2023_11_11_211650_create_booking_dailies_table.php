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
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->nullable();
            $table->string('telephone')->nullable();
            $table->unsignedBigInteger('service_id');
            $table->datetime('datetime');
            $table->string('duration');
            $table->string('information');
            $table->datetime('expired');
            $table->decimal('total', 15, 2);
            $table->string('pin')->nullable();
            $table->text('qr')->nullable();
            $table->enum('status', ['pending', 'success', 'expired'])->nullable()->default('pending');
            $table->timestamps();
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');
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
