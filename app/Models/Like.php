<?php

namespace App\Models;

class Like extends BaseModel
{
    public function liked()
    {
        return $this->morphTo();
    }
}
