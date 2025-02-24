<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateWordRequest;
use App\Models\EnglishWord;

class UpdateController extends Controller
{
    public function index(CreateWordRequest $request, EnglishWord $word)
    {
        $data = $request->validated();
        $word->update($data);
        return $word;
    }
}
