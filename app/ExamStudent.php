<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExamStudent extends Model
{
    protected $guarded = [
        'name' => '',
        'exam_data' => [],
        'Result' => '',
        'total_full_marks'=>'',
        'total_get_marks'=>'',
        'percentage'=>'',
        'grade'=>''
    ];
}
