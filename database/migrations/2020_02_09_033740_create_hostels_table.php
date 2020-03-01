<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHostelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hostels', function (Blueprint $table) {
            $table->increments('id');
            $table->string('hostel_name',100);
            $table->string('type',50);
            $table->text('address')->nullable();
            $table->integer('intake')->nullable();
            $table->text('description')->nullable();
            $table->integer('session_id')->unsigned()->nullable();
            $table->foreign('session_id')->references('id')->on('academic_years')->onDelete('cascade');

            $table->string('is_active')->default('yes')->nullable();
            $table->string('domain')->nullable();
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
        Schema::dropIfExists('hostels');
    }
}
