<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contents', function (Blueprint $table) {
            $table->bigIncrements('id',11);
            $table->string('title',100);
            $table->string('type',50);
            $table->string('available_for',25);
            $table->integer('class_section_id')->length(11)->unsigned()->nullable();
            $table->string('date',20);
            $table->string('description',100)->nullable();
            $table->string('file',100)->nullable();
            $table->string('is_active',25)->default("Yes");
            $table->string('domain',100);
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
        Schema::dropIfExists('contents');
    }
}
