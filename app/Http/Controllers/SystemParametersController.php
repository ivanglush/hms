<?php

namespace App\Http\Controllers;

use App\Repository\SystemParametersRepository;
use Illuminate\Http\Request;

class SystemParametersController extends Controller
{
    private $systemParametersRepository;

    public function __construct(SystemParametersRepository $systemParametersRepository)
    {
        $this->systemParametersRepository = $systemParametersRepository;
    }

    public function index()
    {
        $systemParameters = $this->systemParametersRepository->getAll();

        return view('system_parameters.index', ['systemParameters' => $systemParameters]);
    }

    public function edit()
    {
        $systemParameters = $this->systemParametersRepository->getAll();

        return view('system_parameters.edit', ['systemParameters' => $systemParameters]);
    }

    public function update(Request $request)
    {
        $systemParameters = $this->systemParametersRepository->getAll();
        foreach ($systemParameters as $parameter) {
            $parameter['value'] = $request->get($parameter->name);
            $this->systemParametersRepository->save($parameter);
            //$parameter->save();
        }

        return redirect('system_parameters');
    }


}
