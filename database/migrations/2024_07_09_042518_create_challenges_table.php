<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChallengesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('challenges', function (Blueprint $table) {
            $table->string('challengeID')->primary();
            $table->date('openingDate');
            $table->date('closingDate');
            $table->time('duration');
            $table->string('challengeDescription');
            $table->string('adminUserName');
            $table-> foreign('adminUserName')->references('adminUserName')->on('administrator')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('challenges');
    }
}
