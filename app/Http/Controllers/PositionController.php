<?php

namespace App\Http\Controllers;

use App\Http\Requests\PositionRequest;
use App\Models\Position;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    public function index()
    {
        $positions = Position::all();

        return view('position.index', compact('positions'));
    }

    public function delete(Request $request)
    {
        $id = $request->input('position_id');
        $position = Position::findOrFail($id);
        $position->delete();

        return redirect('positions');
    }

    public function create()
    {

        return view('position.create', compact('positions'));
    }

    public function add(PositionRequest $request)
    {
        $position = new Position();
        $position->position_name = $request->input('position_name');
        $position->position_name_case = $request->input('position_name_case');
        $position->save();

        return redirect('positions');
    }
}
