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
        Schema::create('price_members', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('service_id');
            $table->string('member')->nullable();
            $table->string('category');
            $table->decimal('one_hours', 10, 2)->nullable();
            $table->decimal('two_hours', 10, 2)->nullable();
            $table->decimal('three_hours', 10, 2)->nullable();
            $table->decimal('ten_hours', 10, 2)->nullable();
            $table->decimal('twelve_hours', 10, 2)->nullable();
            $table->decimal('fifteen_hours', 10, 2)->nullable();
            $table->decimal('two_hours_morning', 10, 2)->nullable();
            $table->decimal('three_hours_morning', 10, 2)->nullable();
            $table->decimal('two_hours_afternoon', 10, 2)->nullable();
            $table->decimal('three_hours_afternoon', 10, 2)->nullable();
            $table->decimal('four_hours_afternoon', 10, 2)->nullable();
            $table->decimal('two_months', 10, 2)->nullable();
            $table->decimal('six_months', 10, 2)->nullable();
            $table->decimal('twelve_months', 10, 2)->nullable();
            $table->decimal('two_months_ten_people', 10, 2)->nullable();
            $table->decimal('six_months_ten_people', 10, 2)->nullable();
            $table->decimal('package_a', 10, 2)->nullable();
            $table->decimal('package_b', 10, 2)->nullable();
            $table->decimal('package_c', 10, 2)->nullable();
            $table->decimal('package_d', 10, 2)->nullable();
            $table->decimal('member_coach_club_two_months', 10, 2)->nullable();
            $table->decimal('member_coach_club_two_months_plus_fitness', 10, 2)->nullable();
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
        Schema::dropIfExists('price_members');
    }
};
