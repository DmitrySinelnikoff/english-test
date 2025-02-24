<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\EnglishWord;

class DeleteController extends Controller
{
    public function index(EnglishWord $word)
    {
        $word->delete();
        return response([]);
    }
}
