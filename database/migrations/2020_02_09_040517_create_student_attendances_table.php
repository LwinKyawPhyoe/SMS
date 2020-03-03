<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_attendances', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('admission_no')->nullable();
            $table->string('class_section_id')->nullable();
            $table->string('date')->nullable();
            $table->string('attendance_type_id')->nullable();
            $table->string('biometric_attendance')->nullable();
            $table->string('remark')->nullable();
            $table->string('is_active')->nullable();
            $table->string('domain')->nullable();
            $table->string('session_id')->nullable();
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
        Schema::dropIfExists('student_attendances');
    }
}
