<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassTimetablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_timetables', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('class_section_id')->unsigned();            
            $table->integer('subject_id')->unsigned();
            $table->integer('staff_id')->unsigned();
            $table->char('day', 20);
            $table->char('time_from', 20)->nullable();
            $table->char('time_to', 20)->nullable();
            $table->char('room_no', 20)->nullable();
            $table->char('is_active', 25)->default('yes');
            $table->char('domain', 100);
            $table->integer('session_id')->unsigned();
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
        Schema::dropIfExists('class_timetables');
    }
}
