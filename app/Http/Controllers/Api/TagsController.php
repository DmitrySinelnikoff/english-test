<?php

namespace App\Http\Controllers\Api;

use App\Models\Tag;
use App\Models\Test;
use Illuminate\Support\Facades\Auth;

class TagsController extends Controller
{
    public function index()
    {
        $tags = Tag::all();
        return view('home', compact('tests'));
    }
}
