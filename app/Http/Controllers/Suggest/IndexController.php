<?php

namespace App\Http\Controllers\Suggest;

use App\Enums\StatusEnum;
use App\Http\Controllers\Controller;
use App\Models\EnglishWord;

class IndexController extends Controller
{
    public function index()
    {
        $data = EnglishWord::where('status', StatusEnum::Suggested)->get();
        return view('suggest.index', ['data'=>$data]);
    }
}
