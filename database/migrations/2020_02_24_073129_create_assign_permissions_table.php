<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assign_permissions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('role_id')->unsigned();
            $table->integer('feature_id');
            $table->string('feature');
            $table->integer('can_view');
            $table->integer('can_add');
            $table->integer('can_edit');
            $table->integer('can_delete');
            $table->string('is_active')->default('yes')->nullable();
            $table->string('domain')->nullable();
            $table->integer('session_id')->unsigned();

            $table->foreign('session_id')->references('id')->on('academic_years')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');

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
        Schema::dropIfExists('assign_permissions');
    }
}
