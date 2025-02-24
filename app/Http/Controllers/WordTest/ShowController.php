<?php

namespace App\Http\Controllers\WordTest;

use App\Http\Controllers\Controller;
use App\Models\Test;
use App\Models\TestQuestion;

class ShowController extends Controller
{
    public function index(Test $test, int $question)
    {
        $thisQuestionPage = $question;

        if($thisQuestionPage <= 0) {
            $thisQuestionPage = 1;
        } else if($thisQuestionPage > 10) {
            $thisQuestionPage = 10;
        }

        $thisQuestionIndex = $thisQuestionPage - 1;

        $question = $test->questions->slice($thisQuestionIndex, 1)->first();
        $englishWord = $question->wordCombination->englishWord->word;
        $russianWord = $question->wordCombination->russianWord->word;
        $falseVariant = $question->testWord;
        $variants = array(0,0,0,0);
        $trueVariantPosition = rand(0, 3);

        $variants[$trueVariantPosition] = $russianWord;

        $variantsIndex = 0;
        foreach($falseVariant as $value) {
            if($variantsIndex == $trueVariantPosition)
                $variantsIndex++;

            $variants[$variantsIndex] = $value->russianWord->word;
            $variantsIndex++;
        }

        $result = [
            "question" => $question,
            "englishWord" => $englishWord,
            "russianWord" => $russianWord,
            "variants" => $variants,
            "testID" => $test->id,
            "trueVariantPosition"=> $trueVariantPosition,
            "thisQuestionPage" => $thisQuestionPage,
            "allQuestions" => TestQuestion::select('id', 'result')->where("test_id", $test->id)->get(),
            "testStatus" => TestQuestion::where([['test_id', '=', $test->id], ['result', '=', '0']])->count() == 0 ? 1:0
        ];

        return view('wordtest.show', compact('result'));
    }
}
