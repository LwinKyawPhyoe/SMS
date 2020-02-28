<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomeworksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('homeworks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('class_section_id')->unsigned();
            $table->integer('session_id')->unsigned();
            $table->char('homework_date',20);
            $table->char('submission_date',20);
            $table->integer('staff_id')->unsigned()->nullable();
            $table->integer('subject_id')->unsigned();
            $table->char('document',200)->nullable();
            $table->string('description',500);
            $table->integer('created_by')->unsigned()->nullable();
            $table->char('is_active',25);
            $table->char('domain',100);
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
        Schema::dropIfExists('homeworks');
    }
}
