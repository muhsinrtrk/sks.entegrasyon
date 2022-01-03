<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuesthouseReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guesthouse_reservations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('academicalPersonalId')->unsigned();
            $table->bigInteger('guesthouseId')->unsigned();
            $table->foreign('guesthouseId')->references('id')->on('guesthouses');
            $table->foreign('academicalPersonalId')->references('id')->on('academical_personals');
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
        Schema::dropIfExists('guesthouse_reservations');
    }
}
