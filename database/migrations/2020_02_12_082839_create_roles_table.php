<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 200);
            $table->string('type', 200);
            $table->string('is_active', 25)->default('yes')->nullable();
            $table->text('domain')->nullable();
            $table->integer('session_id')->unsigned()->nullable();
            $table->foreign('session_id')->references('id')->on('academic_years')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**i
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
