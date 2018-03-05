<?php

namespace App\Http\Controllers;

use App\Http\Requests\PositionRequest;
use App\Models\Position;
use App\Repository\PositionRepository;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    private $positionRepository;

    public function __construct(PositionRepository $positionRepository)
    {
        $this->positionRepository = $positionRepository;
    }

    public function index()
    {
        $positions =  $this->positionRepository->getAll();

        return view('position.index', compact('positions'));
    }

    public function delete(Request $request)
    {
        $id = $request->input('position_id');
        /** @var Position $position */
        $position = $this->positionRepository->get($id);
        if($position->users()->count() > 0) {
            return redirect('positions')->withErrors(['errors' => 'На должности '.$position->position_name.' еще есть сотрудники']);
        }
        $this->positionRepository->delete($id);

        return redirect('positions');
    }

    public function create()
    {
        return view('position.create');
    }

    public function edit($id)
    {
        $position = $this->positionRepository->get($id);

        return view('position.edit', compact('position'));
    }

    public function update(PositionRequest $request)
    {
        $position = $this->positionRepository->get($request->position_id);

        $position->position_name = $request->position_name;
        $position->position_name_case = $request->position_name_case;
        $this->positionRepository->update($position);

        return redirect('/positions');
    }

    public function add(PositionRequest $request)
    {
        $position = new Position();
        $position->position_name = $request->input('position_name');
        $position->position_name_case = $request->input('position_name_case');
        $this->positionRepository->save($position);

        return redirect('positions');
    }
}
