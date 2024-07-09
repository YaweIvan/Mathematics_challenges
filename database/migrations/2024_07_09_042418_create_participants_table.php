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
        // Drop the table if it exists
        Schema::dropIfExists('participants');

        // Create the table
        Schema::create('participants', function (Blueprint $table) {
            $table->string('participantId')->primary();
            $table->string('participantUserName')->unique();
            $table->binary('image');
            $table->string('firstName');
            $table->string('lastName');
            $table->string('participantEmail');
            $table->date('dateOfBirth');
            $table->unsignedBigInteger('representativeID');
            $table->string('schoolRegistrationNumber');

            $table->foreign('representativeID')
                  ->references('representativeID')
                  ->on('schoolRepresentatives') // Assuming the table name is `schoolRepresentatives`
                  ->onDelete('cascade');
            $table->foreign('schoolRegistrationNumber')
                  ->references('schoolRegistrationNumber')
                  ->on('schools')
                  ->onDelete('cascade');
            
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
        Schema::table('participants', function (Blueprint $table) {
            $table->dropForeign(['representativeID']);
            $table->dropForeign(['schoolRegistrationNumber']);
        });

        Schema::dropIfExists('participants');
    }
}
