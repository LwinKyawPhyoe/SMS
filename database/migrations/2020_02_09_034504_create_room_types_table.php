<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('room_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('room_type',200);
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
        Schema::dropIfExists('room_types');
    }
}
