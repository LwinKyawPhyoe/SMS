<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffTimelinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff_timelines', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('staff_id')->unsigned();
            $table->string('title')->nullable();
            $table->date('timeline_date');
            $table->string('description')->nullable();
            $table->string('document')->nullable();
            $table->string('status')->nullable();
            $table->string('is_active')->nullable();
            $table->string('domain')->nullable();
            $table->integer('session_id')->unsigned();

            $table->foreign('session_id')->references('id')->on('academic_years')->onDelete('cascade');
            $table->foreign('staff_id')->references('id')->on('staff_directories')->onDelete('cascade');
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
        Schema::dropIfExists('staff_timelines');
    }
}
