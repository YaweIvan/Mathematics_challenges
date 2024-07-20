<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchoolRepresentativeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schoolRepresentative', function (Blueprint $table) {
            $table->string('representativeID')->primary();
            $table->string('schoolRegistrationNumber');
            $table->timestamps();
            $table->foreign('schoolRegistrationNumber')->references('schoolRegistrationNumber')->on('schools')->onDelete('cascade');
            
        });
    
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schoolRepresentative');
    }
}
