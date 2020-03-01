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
            $table->string('name',200);
            $table->string('father_name', 200)->nullable();
            $table->string('mother_name', 200)->nullable();
            $table->string('email',200);
            $table->string('gender',50);
            $table->string('dob', 20);
            $table->string('phone', 200)->nullable();
            $table->string('emergency_contact_no' , 200)->nullable();
            $table->string('marital_status' ,100)->nullable();
            $table->string('image',200)->nullable();
            $table->string('current_address',200)->nullable();
            $table->string('permanent_address', 200)->nullable();
            $table->string('qualification' ,200)->nullable();
            $table->string('work_exp', 200)->nullable();
            $table->string('note', 200)->nullable();
            $table->string('password', 200)->nullable();
            $table->string('epf_no', 200)->nullable();
            $table->string('basic_salary', 200)->nullable();
            $table->string('contract_type', 50)->nullable();
            $table->string('work_shift', 100)->nullable();
            $table->string('location', 100)->nullable();
            $table->string('medical_leave', 100)->nullable();
            $table->string('casual_leave', 100)->nullable();
            $table->string('maternity_leave', 100)->nullable();
            $table->string('account_title', 200)->nullable();
            $table->string('bank_account_no', 200)->nullable();
            $table->string('ifsc_code', 200)->nullable();
            $table->string('bank_branch_name', 100)->nullable();
            $table->string('facebook', 200)->nullable();
            $table->string('twitter', 200)->nullable();
            $table->string('instagram', 200)->nullable();
            $table->string('linkedin', 200)->nullable();
            $table->string('resume', 200)->nullable();
            $table->string('joining_letter', 200)->nullable();
            $table->string('other_document', 200)->nullable();
            $table->string('date_of_joining', 20)->nullable();
            $table->string('date_of_leaving', 20)->nullable();
            $table->string('is_active', 25)->default('yes')->nullable();
            $table->integer('session_id')->unsigned()->nullable();
            $table->foreign('session_id')->references('id')->on('academic_years')->onDelete('cascade');

            $table->string('domain', 100)->nullable();
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
