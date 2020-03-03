<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubjectsGetMarks extends Model
{
    protected $guarded = [
        'subject_name'=>'',
        'get_marks'=>'',
        'full_marks'=>'',
        'passing_marks'=>'',
        'result'=>''
    ];
}
