<?php

namespace App\Models;

class Position extends BaseModel
{
    protected $table = "positions";

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
