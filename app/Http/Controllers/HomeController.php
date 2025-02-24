<?php

namespace App\Http\Controllers;

use App\Models\Test;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $tests = Test::where("user_id", Auth::user()->id)->orderBy("id", "desc")->limit(10)->get();
        return view('home', compact('tests'));
    }
}
