<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffDirectoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff_directories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('staff_id');
            $table->integer('role_id')->unsigned();
            $table->integer('designation_id')->unsigned()->nullable();
            $table->integer('department_id')->unsigned()->nullable();
            $table->string('name');
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('email');
            $table->string('gender');
            $table->string('dob');
            $table->string('phone')->nullable();
            $table->string('emergency_contact_no')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('image')->nullable();
            $table->string('current_address')->nullable();
            $table->string('permanent_address')->nullable();
            $table->string('qualification')->nullable();
            $table->string('work_exp')->nullable();
            $table->string('note')->nullable();
            $table->string('password')->nullable();
            $table->string('epf_no')->nullable();
            $table->string('basic_salary')->nullable();
            $table->string('contract_type')->nullable();
            $table->string('work_shift')->nullable();
            $table->string('location')->nullable();
            $table->string('medical_leave')->nullable();
            $table->string('casual_leave')->nullable();
            $table->string('maternity_leave')->nullable();
            $table->string('account_title')->nullable();
            $table->string('bank_account_no')->nullable();
            $table->string('ifsc_code')->nullable();
            $table->string('bank_branch_name')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('instagram')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('resume')->nullable();
            $table->string('joining_letter')->nullable();
            $table->string('other_document')->nullable();
            $table->string('date_of_joining')->nullable();
            $table->string('date_of_leaving')->nullable();
            $table->string('is_active')->default('yes')->nullable();
            $table->integer('session_id')->unsigned()->nullable();
            $table->foreign('session_id')->references('id')->on('academic_years')->onDelete('cascade');

            $table->string('domain')->nullable();
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            $table->foreign('designation_id')->references('id')->on('designations')->onDelete('cascade');
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
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
        Schema::dropIfExists('staff_directories');
    }
}
