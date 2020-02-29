<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StaffAttendance extends Model
{
    //
       //
       protected $guarded = [];

       public function staffs()
       {
           return $this->belongsTo(StaffDirectory::class);
       }
       public function attendance_types()
       {
           return $this->belongsTo(attendance_type::class);
       }

       public function sessions()
       {
           return $this->belongsTo(AcademicYear::class);
       }
}
