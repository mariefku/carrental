<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->increments('id');

            $table->string('nama');
            $table->string('nohp');
            $table->string('email');
            $table->date('tanggal_lahir');
            $table->string('car_id');
            $table->string('brand');
            $table->string('model');
            $table->string('transmission');
            $table->string('fuel');
            $table->string('destination');
            $table->string('price');
            $table->string('year');

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
        Schema::dropIfExists('bookings');
    }
}
