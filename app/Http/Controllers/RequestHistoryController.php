<?php

namespace App\Http\Controllers;


use App\Models\Request;

class RequestHistoryController extends Controller
{

    public function index($id)
    {
        /** @var Request $request */
        $request = Request::findOrFail($id);
        $histories = $request->requestHistories()->get();

        return view('request.histories', compact('histories'));
    }

    public function updateRequest(Request $request)
    {

    }
}
