<?php

namespace App\Http\Controllers;

use App\Models\EnglishWord;

class MainController extends Controller
{
    public function index()
    {
        return view('main');
    }
}
