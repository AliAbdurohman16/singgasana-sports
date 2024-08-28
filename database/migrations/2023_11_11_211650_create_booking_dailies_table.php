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
            $table->string('identity')->nullable();
            $table->string('rent_lights')->nullable();
            $table->string('rent_ball')->nullable();
            $table->string('rent_racket')->nullable();
            $table->string('rent_bet')->nullable();
            $table->unsignedBigInteger('service_id');
            $table->datetime('datetime');
            $table->datetime('expired_payment');
            $table->datetime('expired_biometrik');
            $table->decimal('subtotal', 15, 2);
            $table->decimal('ppn', 15, 2);
            $table->decimal('total', 15, 2);
            $table->enum('payment_method', ['Cash', 'Transfer', 'QRIS', 'Kredit Card']);
            $table->string('pin')->nullable();
            $table->text('qr')->nullable();
            $table->enum('statu_payment', ['pending', 'success', 'expired', 'rejected'])->nullable()->default('pending');
            $table->enum('statu_biometrik', ['pending', 'success', 'expired', 'rejected'])->nullable()->default('pending');
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
