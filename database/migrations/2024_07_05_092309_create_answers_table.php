<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->string('answerId')->primary();
            $table->string('questionId');
            $table->string('answerText');
            $table->string('adminUserName');
            $table->foreign('adminUserName')->references('adminUserName')->on('administrator')->onDelete('cascade');
            $table->foreign('questionId')->references('questionId')->on('questions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('answers');
    }
}
