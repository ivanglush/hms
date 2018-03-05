<?php
/**
 * Created by PhpStorm.
 * User: Vano
 * Date: 02.03.2018
 * Time: 12:18
 */

namespace App\Observers;


use App\Mail\RequestStateChanged;
use App\Models\Request;
use App\Models\RequestHistory;
use App\Repository\RequestHistoryRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class RequestObserver
{
    private $requestHistoryRepository;

    public function __construct(RequestHistoryRepository $requestHistoryRepository)
    {
        $this->requestHistoryRepository = $requestHistoryRepository;
    }

    public function saving(Request $request)
    {
        //$history->isDirty('stats')

        if (!$request->isDirty('request_state')) {
            return;
        }

        $history = new RequestHistory();
        $history->user_id = Auth::id();
        $history->request_id = $request->id;
        $history->new_state = $request->request_state;

        $this->requestHistoryRepository->save($history);

      //  Mail::to($request->user)->send(new RequestStateChanged($history));
    }
}