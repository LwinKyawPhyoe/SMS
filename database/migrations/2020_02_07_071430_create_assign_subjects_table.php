<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assign_subjects', function (Blueprint $table) {
            $table->bigIncrements('id', 11);            
            $table->integer('class_section_id')->length(11)->unsigned();
            $table->integer('subject_id')->length(11)->unsigned();
            $table->integer('staff_id')->length(11)->unsigned();
            $table->char('description', 100);
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
        Schema::dropIfExists('assign_subjects');
    }
}
