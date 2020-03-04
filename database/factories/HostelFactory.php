<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Hostel;

$factory->define(Hostel::class, function (Faker $faker) {
    $session_ids = App\AcademicYear::pluck('id');
    return [
        /**Faker by wai yan soe */
        'hostel_name' => $faker->name,
        'type' => $faker->name,
        'address' => $faker->address,
        'intake' => 1,
        'description' => $faker->streetAddress,
        'session_id' =>  $session_ids->random(),
        'is_active'  => 'yes',
        'domain' => 'TS',
    ];
});
