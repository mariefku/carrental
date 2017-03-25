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
            $table->string('tanggal_lahir');
            $table->string('id_mobil');
            $table->string('detail_mobil');
            $table->string('id_tujuan');
            $table->string('harga');
            $table->string('rental_tujuan');

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
