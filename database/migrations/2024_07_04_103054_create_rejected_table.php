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
            $table->string('Username')  ->primary();;
            $table->binary('image');
            $table->string('firstName');
            $table->string('lastName');
            $table->string('participantEmail');
            $table->date('dateOfBirth');
            $table->string('schoolRegistrationNumber');
            $table->timestamps();
    
            $table->foreign('schoolRegistrationNumber')
                  ->references('schoolRegistrationNumber')
                  ->on('schools')
                  ->onDelete('cascade');
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
