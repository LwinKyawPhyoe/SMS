<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentExmaData extends Model
{
    protected $guarded = [
        'admission_no' => '',
        'roll_number' => '',
        'student_name' => '',
        'father_name' => '',
        'subjects' => [],
        'grand_total' => '',
        'percent' => '',
        'Result' => '',
    ];
}
