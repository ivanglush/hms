<?php

namespace App\Http\Controllers;

use App\Enums\RequestState;
use App\Mail\RequestStateChanged;
use App\Models\RequestHistory;
use App\Models\SystemParameters;
use App\Models\User;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;

class RequestController extends Controller
{
    public function personalRequests()
    {
        $user = Auth::user();
        $requests = $user->requests; // $user->requests()->get()

        return view('request.personal', compact('requests'));
    }

    public function index(Request $request)
    {
        if ($request->state != null) {
            $requests = \App\Models\Request::where('request_state',$request->state)->paginate(10);
        } else {
            $requests = \App\Models\Request::paginate(10);
        }
        return view('request.index', compact('requests'));
    }

    public function allByUserId($id, Request $request)
    {
        if ($request->state != null) {
            $requests = \App\Models\Request::where('user_id',$id)->where('request_state',$request->state)->paginate(10);
        } else {
            $requests = \App\Models\Request::where('user_id',$id)->paginate(10);
        }


        return view('request.index', compact('requests'));
    }

    public function add(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();
        $this->validate($request, [
            'start_date' => 'required|date|after:tomorrow',
            'end_date' => 'required|date|after:start_date',
        ]);
        $newRequest = new \App\Models\Request();

        $newRequest->start_date = $request->start_date;
        $newRequest->end_date = $request->end_date;
        $newRequest->comment = $request->comment;
        $newRequest->request_state = RequestState::WAITING_FOR_RESPONSE;

        $user->requests()->save($newRequest);

        return redirect()->back();
    }

    public function delete(Request $request)
    {
        $id = $request->input('request_id');
        \App\Models\Request::findOrFail($id)->delete();

        return redirect()->back();
    }

    public function edit($id)
    {
        /** @var User $user */
        $user = Auth::user();

        $request = $user->requests()->where('id', '=', $id)->first();

        return view('request.edit', compact('request'));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'start_date' => 'required|date|after:tomorrow',
            'end_date' => 'required|date|after:start_date',
        ]);
        $oldRequest = \App\Models\Request::findOrFail($request->request_id);

        $oldRequest->update(Input::all());

        return redirect('/requests');
    }

    public function printRequest($id)
    {
        $request = \App\Models\Request::findOrFail($id);
        $user = $request->user;
        $system_parameters = SystemParameters::all();
        $current_date = Carbon::today()->format('d-m-Y');
        $duration = Carbon::parse($request->start_date)->diffInDays(Carbon::parse($request->end_date));

        return view('request.print', compact('user', 'system_parameters', 'request', 'current_date', 'duration'));
    }

    public function changeState(Request $r)
    {
        $request = \App\Models\Request::findOrFail($r->request_id);
        $request->request_state = $r->new_state;
        $request->save();
        $history = new RequestHistory();
//        $history->user()->save(Auth::user());
//        $history->request()->save($request);
        $history->user_id = Auth::id();
        $history->request_id = $request->id;
        $history->new_state = $r->new_state;
        $history->save();

        Mail::to($request->user)->send(new RequestStateChanged($history));

        // $user->requests()->save($newRequest);
        return redirect('/requests');
    }
}
