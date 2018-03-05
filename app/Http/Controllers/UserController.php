<?php

namespace App\Http\Controllers;

use App\Enums\Roles;
use App\Http\Requests\AddUserRequest;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\UserRequest;
use App\Models\Position;
use App\Models\User;
use App\Repository\PositionRepository;
use App\Repository\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;

class UserController extends Controller
{
    private $userRepository;
    private $positionRepository;

    public function __construct(UserRepository $userRepository, PositionRepository $positionRepository)
    {
        // $this->middleware('auth');
        $this->userRepository = $userRepository;
        $this->positionRepository = $positionRepository;
    }

    public function index(Request $request)
    {
        if ($request->sort_by == null) {
            $users = $this->userRepository->getAll();
        } else {
            $users = $this->userRepository->orderBy($request->sort_by);
        }

        return view('user.index', compact('users'));
    }

    public function changeLock(Request $request)
    {
        $user = $this->userRepository->get($request->user_id);
        $user->is_blocked = !$user->is_blocked;
        if ($user->is_blocked) {
            $user->blocked_description = $request->blocked_description;
        } else {
            $user->blocked_description = "";
        }
//        $user->update();
        $this->userRepository->update($user);

        return redirect('/users');
    }

    public function block($id)
    {
        $user = $this->userRepository->get($id);

        return view('user.blocked', compact('user'));
    }

    public function edit($id)
    {
        $user = $this->userRepository->get($id);
        $positions =$this->positionRepository->getAll();
        $roles = Roles::getAll();

        return view('user.edit', compact('user', 'positions', 'roles'));
    }

    public function update(UserRequest $request)
    {
        $user = $this->userRepository->get($request->user_id);
        if ($user->role == Roles::LEADER && $request->role == Roles::EMPLOYEE) {
            $leaders_count = $this->userRepository->getLeadersCount();
            if ($leaders_count <= 1) {
                return redirect('/users/edit/' . $request->user_id)->withErrors(['err1' => 'Невозможно изменить роль. Это последний Руководитель']);
            }
        }

       // $user->update(Input::all());
        $this->userRepository->updateFields($user, Input::all());
        return redirect('/users');
    }

    public function account()
    {
        $user = Auth::user();

        return view('user.account', compact('user'));
    }

    public function editPassword()
    {
        return view('auth.passwords.edit');
    }

    public function add(AddUserRequest $request)
    {
        $user = new User();
        $user->email = $request->email;
        $user->role = $request->role;
        $user->position_id = $request->position_id;

        $this->userRepository->save($user);
    }

    public function create()
    {
        $positions =$this->positionRepository->getAll();
        $roles = Roles::getAll();

        return view('user.create', compact('positions', 'roles'));
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        $user = Auth::user();
        $oldPassword = $request->input('old_password');
        $newPassword = bcrypt($request->input('new_password'));
        if (Hash::check($oldPassword, $user->password)) {
            $user->password = $newPassword;
            $this->userRepository->update($user);

            return redirect('/account');
        }

        return redirect('/account/password');
    }
}
