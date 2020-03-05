<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Department;
use Faker\Generator as Faker;

$factory->define(Department::class, function (Faker $faker) {
    $session_ids = App\AcademicYear::pluck('id');
    return [
        /**Faker by wai yan soe */
        'department_name' => $faker->name,
        'session_id' =>  $session_ids->random(),
        'is_active'  => 'yes',
        'domain' => 'TS',
    ];
});
