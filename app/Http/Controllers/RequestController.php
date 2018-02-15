<?php

namespace App\Http\Controllers;

use App\Enums\RequestState;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RequestController extends Controller
{
    public function personalRequests()
    {
        $user = Auth::user();
        $requests = $user->requests;

        return view('request.index', compact('requests'));
    }

    public function add(Request $request)
    {
        $newRequest = new \App\Models\Request();

        $newRequest->start_date = $request->start_date;
        $newRequest->end_date = $request->end_date;
        $newRequest->comment = $request->comment;
        $newRequest->request_state = RequestState::WAITING_FOR_RESPONSE;
        $newRequest->user_id = Auth::user()->id;

        $newRequest->save();

        return redirect()->back();
    }
}
