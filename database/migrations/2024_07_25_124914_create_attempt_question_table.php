<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttemptQuestionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attempt_question', function (Blueprint $table) {
            $table->string('attempt_question_id')->primary();
            $table->integer('attemptID');
            $table->string('Question_ID');
            $table->binary('image');
            $table->string('challengeID');
            $table->string('selected_answer');
            $table->string('correct_answer');
            $table->decimal('marks', 5, 2); 
            $table->timestamps();
           
            $table->foreign('challengeID')->references('challengeID')->on('challenge')->onDelete('cascade');
            $table->foreign('attemptID')->references('attemptID')->on('attempts')->onDelete('cascade');
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attempt_question');
    }
}
