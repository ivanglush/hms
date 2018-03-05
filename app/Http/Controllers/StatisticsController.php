<?php

namespace App\Http\Controllers;

use App\Enums\RequestState;
use App\Enums\Roles;
use App\Models\SystemParameters;
use App\Models\User;

use App\Repository\UserRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StatisticsController extends Controller
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function personalStats()
    {
        /** @var User $user */
        $user = Auth::user();
        $requests = $user->requests()->where('request_state', '=', RequestState::ACCEPTED)->get();

        //$requests = $user->requests()->where('request_state', '=', RequestState::ACCEPTED)->whereYear('start_date', Carbon::today()->year)->get();
        $duration = 0;
        foreach ($requests as $request) {
            $duration += $request->start_date->diffInDays($request->end_date);
        }

        return view('user.statistics', compact('requests'));
    }

    public function userStatistics($id)
    {
        $user = Auth::user();
        if ($user->id == $id || $user->role == Roles::LEADER) {
            $user = $this->userRepository->get($id);
        }
        $requests = $user->requests()->where('request_state', '=', RequestState::ACCEPTED)->get();

        //$requests = $user->requests()->where('request_state', '=', RequestState::ACCEPTED)->whereYear('start_date', Carbon::today()->year)->get();
        $duration = 0;
        foreach ($requests as $request) {
            $duration += $request->start_date->diffInDays($request->end_date);
        }

        return view('user.statistics', compact('requests'));
    }

    public function statistics($year = null)
    {
        if ($year == null) {
            $year = Carbon::today()->year;
        }
        $users = $this->userRepository->getAll()->where('is_blocked', 0);
        $minHolidayDuration = SystemParameters::where('name', \App\Enums\SystemParameters::MIN_HOLIDAY_DURATION)->first()->value;
        $usedDays = 0;
        $unusedDays = 0;
        foreach ($users as $user) {
            $duration = $this->userRepository->getUsedDaysForYear($user, $year);
            $usedDays += $duration;
            $temp = $minHolidayDuration - $duration;
            $unusedDays += ($temp < 0) ? 0 : $temp;
        }
//        dd($unusedDays);
//        dd($usedDays);

        return view('statistics.index', compact('usedDays', 'unusedDays', 'year'));
    }
}
