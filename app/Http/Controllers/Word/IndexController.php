<?php

namespace App\Http\Controllers\Word;

use App\Enums\StatusEnum;
use App\Http\Controllers\Controller;
use App\Models\EnglishWord;

class IndexController extends Controller
{
    public function index()
    {
        $words = EnglishWord::where('status', StatusEnum::Approved)->paginate(81);
        return view('word.index', compact('words'));
    }
}
