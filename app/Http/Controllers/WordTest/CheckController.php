<?php

namespace App\Http\Controllers\WordTest;

use App\Http\Controllers\Controller;
use App\Models\TestQuestion;
use Illuminate\Http\Request;

class CheckController extends Controller
{
    public function index(Request $request)
    {
        $question = TestQuestion::where("id", $request->question)->first();
        $question->update([
            "result" => $request->otv == 1 ? 2:1
        ]);

        $nextPage = strval($request->thisQuestionPage + 1);
        return redirect("/wordtest/show/{$request->testID}/{$nextPage}");
    }
}
