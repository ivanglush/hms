<?php

namespace App\Models;

class Request extends BaseModel
{
    protected $table = "requests";

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
