<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRejectedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rejected', function (Blueprint $table) {
            $table->string('rejectStudentId')->primary();
            $table->string('rejectStudentName')->unique();
            $table->binary('image');
            $table->string('firstName');
            $table->string('lastName');
            $table->string('rejectStudentEmail');
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
        Schema::dropIfExists('rejected');
    }
}
