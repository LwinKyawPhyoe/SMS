<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoomType extends Model
{
    //
    protected $guarded = [];

    public function session()
    {
        return $this->belongsTo(AcademicYear::class);
    }
}
