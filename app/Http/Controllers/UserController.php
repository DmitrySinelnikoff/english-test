<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Test;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{   
    public function index()
    {
        $users = User::all()->paginate(10);
        return view('user.index', compact('users'));
    }

    public function show(User $user)
    {
        $tests = Test::where('user_id', $user->id)->orderBy('id', 'desc')->limit(10)->get();
        return view('user.show', compact('tests', 'user'));
    }

    public function edit()
    {
        $user = Auth::user();
        return view('user.edit', compact('user'));
    }

    public function update(UserRequest $request)
    {
        $user = Auth::user();
        $data = $request->validated();
        $user->update($data);
        return redirect()->route('user.show', ['user' => Auth::user()]);
    }

    public function destroy()
    {
        $user = Auth::user();
        $user->delete();
        return redirect()->route('main.index');
    }

    public function home()
    {
        $user = Auth::user();
        $tests = Test::where('user_id', $user->id)->orderBy('id', 'desc')->limit(10)->get();
        return view('user.show', compact('tests', 'user'));
    }
}
