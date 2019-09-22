<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProfileStatus extends Model
{
    protected $guarded = [];

    public function profiles()
    {
        return $this->hasMany(Profile::class);
    }
}
