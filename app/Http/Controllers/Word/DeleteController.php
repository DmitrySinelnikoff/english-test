<?php

namespace App\Http\Controllers\Word;

use App\Http\Controllers\Controller;
use App\Models\EnglishWord;

class DeleteController extends Controller
{
    public function index(EnglishWord $word)
    {
        $word->delete();
        return redirect()->route('all.index');
    }
}
