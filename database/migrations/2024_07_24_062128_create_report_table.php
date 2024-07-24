<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report', function (Blueprint $table) {
            $table->string('schoolRegistrationNumber');
            $table->string('challengeID');
            $table->string('Most_Correctly_Answered_Questions');
            $table->string('School_Rankings');
            $table->string('Perfomance_Over_Time');
            $table->decimal('Question_Repetition_Rate', 5, 2);
            $table->string('Worst_Perfoming_School');
            $table->string('Best_Perfoming_Schools');
            $table->string('Incomplete_Challenges');
            $table->timestamps();
            $table->foreign('schoolRegistrationNumber')->references('schoolRegistrationNumber')->on('schools')->onDelete('cascade');
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
        Schema::dropIfExists('report');
    }
}
