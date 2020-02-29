<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class fillMarksTH extends Model
{
    protected $guarded = [
        'subject' => '',
        'full_marks' => '',
        'passing_marks' => '',
    ];
}
