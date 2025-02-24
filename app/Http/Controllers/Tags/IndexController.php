<?php

namespace App\Http\Controllers\Tags;

use App\Http\Controllers\Controller;
use App\Models\Tag;

class IndexController extends Controller
{
    public function index()
    {
        $tags = Tag::all()->paginate(81);
        return view('tags.index', compact('tags'));
    }
}
