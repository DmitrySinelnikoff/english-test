<?php

namespace App\Http\Controllers;

use App\Models\Test;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{   
    public function index()
    {
        $users = User::all()->paginate(81);
        return view('user.index', compact('users'));
    }

    public function show(User $user)
    {
        $tests = Test::where("user_id", $user->id)->orderBy("id", "desc")->limit(10)->get();
        return view('user.show', compact('tests', 'user'));
    }

    public function edit(Tag $tag)
    {

    }

    public function update(TagRequest $request, Tag $tag)
    {

    }

    public function destroy(Tag $tag)
    {

    }
}
