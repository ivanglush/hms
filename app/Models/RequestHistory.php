<?php

namespace App\Models;

use App\Models\Request;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed $user
 * @property mixed $request
 */
class RequestHistory extends Model
{
    protected $table = "request_histories";

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function request()
    {
        return $this->belongsTo(Request::class);
    }
}
