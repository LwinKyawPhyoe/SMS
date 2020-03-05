<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->bigIncrements('id');/* 1*/
            $table->string('admission_no')->nullable();/*2 */
            $table->string('name')->nullable();/* 3*/
            $table->string('image')->nullable();/*4 */
            $table->string('mobileno')->nullable();/* 5*/
            $table->string('email')->nullable();/* 6*/
            $table->string('gender')->nullable();/*7 */
            $table->string('dob')->nullable();/*8 */
            $table->string('religion')->nullable();/*9 */
            $table->string('blood_group')->nullable();/*10 */
            $table->string('height')->nullable();/* 11*/
            $table->string('weight')->nullable();/*12 */
            $table->string('roll_no')->nullable();/* 13*/
            $table->string('class_sections_id')->nullable();/* 14*/
            $table->string('admission_date')->nullable();/* 15*/
            $table->string('register_date')->nullable();/* 16*/
            $table->string('father_name')->nullable();/* 17*/
            $table->string('father_phone')->nullable();/* 18*/
            $table->string('father_nrc')->nullable();/* 19*/
            $table->string('father_job')->nullable();/* 20*/
            $table->string('father_photo')->nullable();/* 21*/
            $table->string('mother_name')->nullable();/* 22*/
            $table->string('mother_phone')->nullable();/* 23*/
            $table->string('mother_nrc')->nullable();/* 24*/
            $table->string('mother_job')->nullable();/* 25*/
            $table->string('mother_photo')->nullable();/* 26*/
            $table->string('guardian_name')->nullable();/* 27*/
            $table->string('guardian_nrc')->nullable();/* 28*/
            $table->string('guardian_phone')->nullable();/* 29*/
            $table->string('guardian_job')->nullable();/* 30*/
            $table->string('guardian_relation')->nullable();/* 31*/
            $table->string('guardian_email')->nullable();/* 32*/
            $table->string('guardian_photo')->nullable();/* 33*/
            $table->string('guardian_address')->nullable();/*34 */
            $table->string('current_address')->nullable();/*35 */
            $table->string('permanent_address')->nullable();/*36 */
            $table->string('previous_school')->nullable();/*37 */
            $table->string('route_id')->nullable();/*38 */
            $table->string('hostel_room_id')->nullable();/*39 */
            $table->string('session_start')->nullable();/* 40*/
            $table->string('session_end')->nullable();/* 41*/
            $table->string('note')->nullable();/*42 */
            $table->string('disable_at')->nullable();/* 43*/
            $table->string('domain')->nullable();/* 44*/
            $table->string('is_active')->nullable();/*45 */
            $table->string('session_id')->nullable();/* 46 */
            $table->string('race')->nullable();
            $table->string('result')->nullable();
            $table->string('session_status')->nullable();
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
        Schema::dropIfExists('students');
    }
}
