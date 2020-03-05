<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\StaffDirectory;

$factory->define(StaffDirectory::class, function (Faker $faker) {
    $role_ids = App\Role::pluck('id');
    $designation_ids = App\Designation::pluck('id');
    $department_ids = App\Department::pluck('id');
    $session_ids = App\AcademicYear::pluck('id');

    $gender = $faker->randomElement(['male', 'female']);

    return [
        //
        /**Faker by wai yan soe */
        'staff_id' => $faker->randomNumber,
        'role_id' => $role_ids->random(),
        'designation_id' => $designation_ids->random(),
        'department_id' => $department_ids->random(),
        'name' => $faker->userName,
        'father_name' => $faker->name,
        'mother_name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'gender' => $gender,
        'dob' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'phone' => $faker->phoneNumber,
        'emergency_contact_no' => $faker->phoneNumber,
        'password' => bcrypt('secret'),
        'session_id' =>  $session_ids->random(),
        'is_active'  => 'yes',
        'domain' => 'TS',

        
    ];
});
