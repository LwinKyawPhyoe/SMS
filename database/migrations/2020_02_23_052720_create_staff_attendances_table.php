<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff_attendances', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');
            $table->integer('staff_id')->unsigned();
            $table->integer('staff_attendance_type_id')->unsigned();
            $table->string('note')->nullable();
            $table->string('is_active')->default('yes')->nullable();
            $table->string('domain')->nullable();
            $table->integer('session_id')->unsigned();

            $table->foreign('session_id')->references('id')->on('academic_years')->onDelete('cascade');
            $table->foreign('staff_id')->references('id')->on('staff_directories')->onDelete('cascade');
            $table->foreign('staff_attendance_type_id')->references('id')->on('attendance_types')->onDelete('cascade');
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
        Schema::dropIfExists('staff_attendances');
    }
}
