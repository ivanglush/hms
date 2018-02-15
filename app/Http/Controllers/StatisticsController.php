<?php

namespace App\Http\Controllers;

use App\Enums\RequestState;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StatisticsController extends Controller
{


    public function personalStats()
    {
        $user = Auth::user();
        $requests = $user->requests->where('request_state', '=', RequestState::ACCEPTED);
//           dd($requests);
        return view('user.statistics', compact('requests'));
    }
}
