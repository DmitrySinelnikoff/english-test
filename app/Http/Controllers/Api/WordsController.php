<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\EnglishWord;

class WordsController extends Controller
{
    public function index()
    {
        $words = EnglishWord::all();
        return $words;
    }
}
