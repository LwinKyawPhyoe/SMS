<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    //
    protected $guarded = [];

    public function sessions()
    {
        return $this->belongsTo(AcademicYear::class);
    }
}
