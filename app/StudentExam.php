<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentExam extends Model
{
    protected $guarded = [
        'admission_no' => '',
        'roll_no' => '',
        'student_name' => '',
        'subjects'=>[]
    ];
}
