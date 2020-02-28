<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssignPermission extends Model
{
    //
    protected $guarded = [];

    public function roles()
    {
        return $this->belongsTo(Role::class);
    }
}
