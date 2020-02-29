<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentExamDataSubjects extends Model
{
    protected $guarded = [
        'get_marks'=>'',
        'exam_schadule_id'=>'',
        'passing_marks'=>'',
        'attendence'=>'',
        'full_marks'=>'',
        'id'=>''
    ];
}
