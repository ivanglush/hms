<?php

namespace App\Models;

use App\Models\RequestHistory;

/**
 * @property mixed $request_histories
 * @property mixed $user
 */
class Request extends BaseModel
{
    protected $table = "requests";

    protected $fillable = [
        'start_date', 'end_date', 'comment'
    ];

    public function getDates()
    {
        return array_merge(parent::getDates(), [
            'start_date', 'end_date'
        ]);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function requestHistories()
    {
        return $this->hasMany(RequestHistory::class);
    }
}
