<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StaffDirectory extends Model
{
    //
    protected $guarded = [];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
    public function designation()
    {
        return $this->belongsTo(Designation::class);
    }

    public function sessions()
    {
        return $this->belongsTo(AcademicYear::class);
    }

}
