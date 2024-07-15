<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParticipantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participants', function (Blueprint $table) {
            $table->string('participantId')->primary();
            $table->string('participantUserName')->unique();
            $table->binary('image');
            $table->string('firstName');
            $table->string('lastName');
            $table->string('participantEmail');
            $table->date('dateOfBirth');
            $table-> string ('representativeID');
            $table->string('schoolRegistrationNumber');

            $table->foreign('schoolRegistrationNumber')->references('schoolRegistrationNumber')->on('schools')->onDelete('cascade');
            $table->foreign('representativeID')->references('representativeID')->on('schoolRepresentative')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('participants');
    }
}
