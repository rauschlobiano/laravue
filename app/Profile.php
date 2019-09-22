<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $guarded = [];

    public function profiletype()
    {
        return $this->belongsTo(ProfileType::class);
    }
    public function profilegroup()
    {
        return $this->belongsTo(ProfileGroup::class);
    }
    public function profilestatus()
    {
        return $this->belongsTo(ProfileStatus::class);
    }
}
