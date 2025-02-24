<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\EnglishWord;

class TranslateController extends Controller
{
    public function index(string $word)
    {
        $data = EnglishWord::where("word", $word)->first()->translate->first();
        return $data;
    }
}
