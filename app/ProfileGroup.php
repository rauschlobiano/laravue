<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProfileGroup extends Model
{
    protected $guarded = [];

    public function profiles()
    {
        return $this->hasMany(Profile::class);
    }
}
