<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentHasCommunitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('student_has_communities');
        Schema::create('student_has_communities', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('studentId')->unsigned();
            $table->bigInteger('communityId')->unsigned();
            $table->foreign('studentId')->references('id')->on('students');
            $table->foreign('communityId')->references('id')->on('communities');
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
        Schema::dropIfExists('student_has_communities');
    }
}
