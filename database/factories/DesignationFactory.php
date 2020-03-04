<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Designation;
use Faker\Generator as Faker;

$factory->define(Designation::class, function (Faker $faker) {
    $session_ids = App\AcademicYear::pluck('id');
    return [
        /**Faker by wai yan soe */
        'designation_name' => $faker->name,
        'session_id' =>  $session_ids->random(),
        'is_active'  => 'yes',
        'domain' => 'TS',
    ];
});
