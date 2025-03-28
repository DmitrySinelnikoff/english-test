<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use App\Models\User;
use App\Models\WordView;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    public function index()
    {
        $tags = Tag::withCount('words')->get();
        $views = WordView::mostShowed();
        $users = User::select('id', 'name')->orderBy('id', 'desc')->limit(10)->get();

        $viewed = [];
        if(Auth::check() == true)
        {
            $viewed = User::viewed();
        }

        return view('main.index', compact('tags', 'views', 'viewed', 'users'));
    }
}
