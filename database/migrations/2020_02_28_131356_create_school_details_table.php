<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchoolDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('school_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('school_name')->nullable();
            $table->string('school_code')->nullable();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('session')->nullable();
            $table->string('session_month')->nullable();
            $table->string('language')->nullable();
            $table->string('domain')->nullable();
            $table->string('schoollogo')->nullable();
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
        Schema::dropIfExists('school_details');
    }
}
