<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttemptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attempts', function (Blueprint $table) {
            $table->integer('attemptID')->primary();
            $table->string('challengeID');
            $table->decimal('score');
            $table->integer('timeTaken');
            $table->string('schoolRegistrationNumber');
            $table->timestamps();
            $table->foreign('schoolRegistrationNumber')->references('schoolRegistrationNumber')->on('participants')->onDelete('cascade');
            $table->foreign('challengeID')->references('challengeID')->on('challenge')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attempts');
    }
}
