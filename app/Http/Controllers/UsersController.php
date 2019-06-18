<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', [
            'except' => ['create', 'show', 'store'],
        ]);

        $this->middleware('guest', [
            'only' => ['create'],
        ]);
    }

    public function create()
    {
        return view('users.create');
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:2|max:50',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|confirmed|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => \bcrypt($request->password),
        ]);

        Auth::login($user);

        session()->flash('success', '欢迎，您将在这里开启一段的的旅途～');

        return redirect()->route('users.show', $user);
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user);

        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $this->authorize('update', $user);

        $this->validate($request, [
            'name' => 'required|min:2|max:50',
        ]);

        $user->update([
            'name' => $request->name,
        ]);

        session()->flash('success', '个人资料更新成功！');

        return redirect()->route('users.show', $user);
    }

    public function destroy(User $user)
    {
        $this->authorize('destroy', $user);
    }

    public function showResetPasswordForm(User $user)
    {
        $this->authorize('update', $user);

        return view('users.reset_password', compact('user'));
    }

    public function resetPassword(Request $request, User $user)
    {
        $this->authorize('update', $user);

        $this->validate($request, [
            'password' => 'required|min:6|confirmed',
        ]);

        $user->update([
            'password' => bcrypt($request->password),
        ]);

        session()->flash('success', '密码修改成功！');

        return redirect()->route('users.show', $user);
    }

    public function index(Request $request)
    {
        $users = User::paginate('10');

        return view('users.index', compact('users'));
    }
}
