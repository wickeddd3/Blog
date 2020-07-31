<?php

namespace App\Models;

class Profile extends BaseModel
{
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
