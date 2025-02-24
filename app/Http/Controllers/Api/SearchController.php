<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\EnglishWord;

class SearchController extends Controller
{
    public function index(string $word)
    {
        $dataWord = EnglishWord::all()->where('word', $word)->first();
        return $dataWord;
    }
}
