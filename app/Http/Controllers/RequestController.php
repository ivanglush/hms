<?php

namespace App\Http\Controllers;

use App\Enums\RequestState;
use App\Http\Requests\RequestRequest;
use App\Mail\RequestStateChanged;
use App\Models\RequestHistory;
use App\Models\SystemParameters;
use App\Models\User;

use App\Repository\RequestHistoryRepository;
use App\Repository\RequestRepository;
use App\Repository\UserRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;

class RequestController extends Controller
{
    private $requestRepository;
    private $requestHistoryRepository;
    private $userRepository;

    public function __construct(RequestRepository $requestRepository, RequestHistoryRepository $requestHistoryRepository, UserRepository $userRepository)
    {
        $this->requestRepository = $requestRepository;
        $this->requestHistoryRepository = $requestHistoryRepository;
        $this->userRepository = $userRepository;
    }

    public function personalRequests()
    {
        $user = Auth::user();
        $requests = $user->requests; // $user->requests()->get()

        return view('request.personal', compact('requests'));
    }

    public function index(Request $request)
    {
        $selectedUser = $request->user_id;
        $selectedState = $request->state;
        if ($selectedUser != null) {
            $requests =$this->requestRepository->getAllByUserId($selectedUser);
            if ($selectedState != null ) {
               $requests = $requests->where('request_state', $selectedState);
            }
        } else if ($selectedState != null ) {
            $requests = $this->requestRepository->getAllByState($selectedState);
        } else {
            $requests = $this->requestRepository->getAll();
        }

        $users = $this->userRepository->getAll();
        $states = RequestState::getAll();

        return view('request.index', compact('requests', 'users', 'states', 'selectedState', 'selectedUser'));
    }

    public function allByUserId($id, Request $request)
    {
        if ($request->state != null) {
            $requests = $this->requestRepository->getAllByState($request->state)->where('user_id',$id);
        } else {
            $requests = $this->requestRepository->getAll()->where('user_id', $id);
        }

        return view('request.index', compact('requests'));
    }

    public function create()
    {
        $request = new \App\Models\Request();
        return view('request.create');
    }

    public function add(RequestRequest $request)
    {
        /** @var User $user */
        $user = Auth::user();
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
//        \App\Models\Request::findOrFail($id)->delete();
        $this->requestRepository->delete($this->requestRepository->get($id));

        return redirect()->back();
    }

    public function edit($id)
    {
        /** @var User $user */
        $user = Auth::user();

        $request = $user->requests()->where('id', '=', $id)->first();

        return view('request.edit', compact('request'));
    }

    public function update(RequestRequest $request)
    {
        $oldRequest = $this->requestRepository->get($request->request_id);

        $this->requestRepository->updateFields($oldRequest, Input::all());

        return redirect('/requests');
    }

    public function printRequest($id)
    {
        $request = $this->requestRepository->get($id);
        $user = $request->user;
        $system_parameters = SystemParameters::all();
        $current_date = Carbon::today();
        $duration = $request->start_date->diffInDays($request->end_date);

        return view('request.print', compact('user', 'system_parameters', 'request', 'current_date', 'duration'));
    }

    public function changeState(Request $r)
    {
        $request = $this->requestRepository->get($r->request_id);
        $request->request_state = $r->new_state;
        $this->requestRepository->save($request);

        // $user->requests()->save($newRequest);
        return redirect('/requests');
    }
}
