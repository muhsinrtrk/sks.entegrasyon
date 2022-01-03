<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacilityReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facility_reservations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('studentId')->unsigned()->nullable();
            $table->bigInteger('facilityId')->unsigned();
            $table->bigInteger('academicalPersonalId')->unsigned()->nullable();
            $table->foreign('studentId')->references('id')->on('students');
            $table->foreign('facilityId')->references('id')->on('facilities');
            $table->foreign('academicalPersonalId')->references('id')->on('academical_personals');
            $table->timestamp('reservastionDate');
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
        Schema::dropIfExists('facility_reservations');
    }
}
