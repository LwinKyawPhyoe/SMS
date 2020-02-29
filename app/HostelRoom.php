<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HostelRoom extends Model
{
    //
    protected $guarded = [];

    public function roomType()
    {
        return $this->belongsTo(RoomType::class);
    }
    public function hostel()
    {
        return $this->belongsTo(Hostel::class);
    }

    public function sessions()
    {
        return $this->belongsTo(AcademicYear::class);
    }
}
