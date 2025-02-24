<?php

namespace App\Http\Controllers\WordTest;

use App\Http\Controllers\Controller;
use App\Models\Test;
use App\Models\TestQuestion;

class ResultController extends Controller
{
    public function index(Test $test)
    {
        $results = TestQuestion::where('test_id', $test->id)->get();
        $trueAnswerCount = $results->where('result', 2)->count(); 
        return view('wordtest.result', ['results' => $results, 'trueAnswerCount' => $trueAnswerCount]);
    }
}
