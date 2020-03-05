<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\HostelRoom;
use Faker\Generator as Faker;

$factory->define(HostelRoom::class, function (Faker $faker) {
    $session_ids = App\AcademicYear::pluck('id');
    $hostel_ids = App\Hostel::pluck('id');
    $room_ids = App\RoomType::pluck('id');

    return [
        /**Faker by wai yan soe */
        'hostel_id' => $hostel_ids->random(),
        'room_type_id' => $room_ids->random(),
        'room_no' => $faker->address,
        'no_of_bed' => $faker->randomNumber,
        'cost_per_bed' => $faker->randomNumber,
        'description' => $faker->streetAddress,
        'session_id' =>  $session_ids->random(),
        'is_active'  => 'yes',
        'domain' => 'TS',
    ];
});
