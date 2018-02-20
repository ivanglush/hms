<?php

namespace App\Http\Controllers;

use App\Enums\RequestState;
use App\Models\User;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StatisticsController extends Controller
{

    public function personalStats()
    {
        /** @var User $user */
        $user = Auth::user();
        $requests = $user->requests()->where('request_state', '=', RequestState::ACCEPTED)->get();

        $requests = $user->requests()->where('request_state', '=', RequestState::ACCEPTED)->whereYear('start_date',Carbon::today()->year)->get();
        $duration = 0;
        foreach ($requests as $request){
            $duration += Carbon::parse($request->start_date)->diffInDays(Carbon::parse($request->end_date));
        }
        dd($duration);

        return view('user.statistics', compact('requests'));
    }
}
