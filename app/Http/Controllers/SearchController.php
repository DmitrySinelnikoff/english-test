<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EnglishWord;
use App\Models\RussianWord;
use App\Models\Tag;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $englishWords = EnglishWord::where([['word','LIKE',"%{$search}%"], ['word_status_id', '=', 2]])->limit(10)->get();
        $russianWords = RussianWord::where('word','LIKE',"%{$search}%")->limit(10)->get();
        $tags = Tag::where('name','LIKE','%{$search}%')->limit(10)->get();
        
        return view('search.index', compact('englishWords', 'russianWords', 'tags'));
    }
}
