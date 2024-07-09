<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRepresentativeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('representative', function (Blueprint $table) {
            $table->string('representativeID')->primary();
            $table->string('representativeName');
            $table->string('representativeEmail')->unique();
            $table->string('schoolRegistrationNumber');
            $table->string('adminUserName');
            $table->timestamps();

            $table->foreign('schoolRegistrationNumber')->references('schoolRegistrationNumber')->on('schools')->onDelete('cascade');
            $table->foreign('adminUserName')->references('adminUserName')->on('administrator')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('representative');
    }
}
