<?php

namespace App\Http\Controllers;


use App\Models\Request;
use App\Repository\RequestRepository;

class RequestHistoryController extends Controller
{

    private $requestRepository;

    public function __construct(RequestRepository $requestRepository)
    {
        $this->requestRepository = $requestRepository;
    }

    public function index($id)
    {
        /** @var Request $request */
        $request = $this->requestRepository->get($id);
        $histories = $request->requestHistories;

        return view('request.histories', compact('histories'));
    }

    public function updateRequest(Request $request)
    {

    }
}
