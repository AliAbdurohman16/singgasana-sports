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
        Schema::create('price_dailies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('service_id');
            $table->string('category')->nullable();
            $table->string('package')->nullable();
            $table->decimal('price')->nullable();
            $table->decimal('morning', 10, 2)->nullable();
            $table->decimal('afternoon', 10, 2)->nullable();
            $table->decimal('weekday', 10, 2)->nullable();
            $table->decimal('weekend', 10, 2)->nullable();
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
        Schema::dropIfExists('price_dailies');
    }
};
