<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StaffTimeline extends Model
{
    //
    protected $guarded = [];

    public function staffs()
    {
        return $this->belongsTo(StaffDirectory::class);
    }


    public function sessions()
    {
        return $this->belongsTo(AcademicYear::class);
    }
}
