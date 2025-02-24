<?php

namespace App\Http\Controllers\WordTest;

use App\Http\Controllers\Controller;
use App\Models\Test;
use Illuminate\Support\Facades\Auth;

class ListController extends Controller
{
    public function index(Test $test)
    {
        $tests = Test::where("user_id", Auth::user()->id)->orderBy("id", "desc")->paginate(12);
        return view('wordtest.list', compact('tests'));
    }
}
