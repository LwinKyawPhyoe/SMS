<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomeworkEvaluationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('homework_evaluations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('homework_id')->unsigned();
            $table->char('com_admission_no',100);
            $table->char('incom_admission_no',100);
            $table->integer('session_id')->unsigned();
            $table->char('date',20);
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
        Schema::dropIfExists('homework_evaluations');
    }
}
