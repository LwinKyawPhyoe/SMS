<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHostelRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hostel_rooms', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('hostel_id')->unsigned();
            $table->integer('room_type_id')->unsigned();
            $table->string('room_no', 200);
            $table->integer('no_of_bed');
            $table->string('cost_per_bed');
            $table->text('description')->nullable();
            $table->string('is_active')->default('Yes')->nullable();
            $table->string('domain')->nullable();
            $table->foreign('hostel_id')->references('id')->on('hostels')->onDelete('cascade');
            $table->foreign('room_type_id')->references('id')->on('room_types')->onDelete('cascade');
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
        Schema::dropIfExists('hostel_rooms');
    }
}
