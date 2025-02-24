<?php

namespace App\Http\Controllers\Suggest;

use App\Enums\StatusEnum;
use App\Http\Controllers\Controller;
use App\Models\EnglishWord;
use Illuminate\Http\Request;

class ApprovedController extends Controller
{
    public function index(Request $request, EnglishWord $word)
    {
        $word->status = StatusEnum::Approved;
        $word->save();
        return redirect()->route('suggest.index');
    }
}
