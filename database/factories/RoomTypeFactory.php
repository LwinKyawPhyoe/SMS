<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\RoomType;


$factory->define(RoomType::class, function (Faker $faker) {
    $session_ids = App\AcademicYear::pluck('id');
    return [
        /**Faker by wai yan soe */
        'room_type' => $faker->name,
        'description' => $faker->address,
        'session_id' =>  $session_ids->random(),
        'is_active'  => 'yes',
        'domain' => 'TS',
    ];
});
