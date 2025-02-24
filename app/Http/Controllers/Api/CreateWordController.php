<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateWordRequest;
use App\Models\EnglishWord;

class CreateWordController extends Controller
{
    public function index(CreateWordRequest $request)
    {
        $data = $request->validated();
        $words = EnglishWord::create($data);
        return $words;
    }
}
