<?php

namespace App\Http\Controllers\Suggest;

use App\Http\Controllers\Controller;
use App\Models\RussianWord;
use App\Models\Tag;

class CreateController extends Controller
{
    public function index()
    {
        $tags = Tag::all();
        $russianWords = RussianWord::all();
        return view('suggest.create', ['tags' => $tags, 'russianWords' => $russianWords]);
    }
}
