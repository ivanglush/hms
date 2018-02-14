<?php

namespace App\Http\Controllers;

use App\Enums\Roles;
use App\Models\Position;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;

class UserController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function index()
    {
        $users = User::all();

        return view('user.index', compact('users'));
    }

    public function changeLock(Request $request)
    {
        $user = User::find($request->input('user_id'));
        $user->is_blocked = !$user->is_blocked;
        if ($user->is_blocked) {
            $user->blocked_description = $request->input('blocked_description');
        } else {
            $user->blocked_description = "";
        }
        $user->update();

        return redirect('/users');
    }

    public function block($id)
    {
        $user = User::find($id);

        return view('user.blocked', compact('user'));
    }

    public function edit($id)
    {
        $user = User::find($id);
        $positions = Position::all();
        $roles = Roles::getAll();

        return view('user.edit', compact('user', 'positions', 'roles'));
    }

    public function update(Request $request)
    {
        $user = User::find($request->get('user_id'));
        if ($user->role == Roles::LEADER && $request->get('role') == Roles::EMPLOYEE) {
            $leaders_count = User::all()->where('role', '=', 'leader')->count();
            if ($leaders_count <= 1) {
                return redirect('/users/edit/' . $request->user_id)->withErrors(['err1' => 'Невозможно изменить роль. Это последний Руководитель']);
            }
        }
        /* $v = \Validator::make($request->toArray(), [
             'email' => 'required|email',
             'role' => 'sometimes',
         ]);
         $v->sometimes('role', 'required', function ($input) {
             $user = User::find($input->get('user_id'));
             if($user->role==Roles::LEADER && $input->get('role')==Roles::EMPLOYEE) {
                 $leaders_count = User::all()->where('role','=','leader')->count();
                dd( $leaders_count>=2);
                 return $leaders_count>=2;
             }
             return true;
         });
         if($v->fails()) {
             return redirect('/users/edit/1')->withErrors($v)->withInput();
         }*/

        $user->update(Input::all());

        return redirect('/users');
    }

    public function account()
    {
        $user = \Auth::user();

        return view('user.account', compact('user'));
    }

    public function editPassword()
    {

        return view('auth.passwords.edit');
    }

    public function changePassword(Request $request)
    {
        $user = Auth::user();
        $oldPassword = $request->input('old-password');
        $newPassword = bcrypt($request->input('new-password'));
        if (Hash::check($oldPassword, $user->password)) {
            $user->password = $newPassword;
            $user->update();

            return redirect('/account');
        }

        return redirect('/account/password');
    }
}
