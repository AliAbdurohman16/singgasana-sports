<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_members', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->unsignedBigInteger('user_id');
            $table->string('identity')->nullable();
            $table->unsignedBigInteger('service_id');
            $table->date('date');
            $table->time('play_start')->nullable();
            $table->time('play_end')->nullable();
            $table->string('member')->nullable();
            $table->string('category')->nullable();
            $table->string('package');
            $table->string('play_duration')->nullable();
            $table->string('school')->nullable();
            $table->datetime('expired_payment')->nullable();
            $table->datetime('expired_biometrik');
            $table->decimal('subtotal', 15, 2);
            $table->decimal('ppn', 15, 2);
            $table->decimal('total', 15, 2);
            $table->decimal('total_for_school', 15, 2);
            $table->enum('payment_method', ['Cash','Debit','Qris','Transfer','Credit Card']);
            $table->string('pin')->nullable();
            $table->text('qr')->nullable();
            $table->enum('status_payment', ['pending', 'success', 'expired', 'rejected'])->nullable()->default('pending');
            $table->enum('status_biometrik', ['pending', 'success', 'expired', 'rejected'])->nullable()->default('pending');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('booking_members');
    }
};
