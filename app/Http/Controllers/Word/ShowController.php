<?php

namespace App\Http\Controllers\Word;

use App\Http\Controllers\Controller;
use App\Models\EnglishWord;
use App\Models\TestQuestion;
use App\Models\WordView;

class ShowController extends Controller
{
    public function index(EnglishWord $word)
    {
        if(auth()->check()){
            WordView::createViewLog($word);
        }

        $results = [];
        $translates = $word->englishRussian()->get();
        foreach($translates as $key => $translate){
            $testQuestion = TestQuestion::where('english_russian_word_id', $translate->id)->get();
            $testQuestionCount = $testQuestion->count();
            $trueAnswerCount = $testQuestion->where('result', 2)->count();
            $falseAnswerCount = $testQuestion->where('result', 1)->count();

            $results[$key] = [
                'englishWord' => $word->word,
                'russianWord' => $translate->russianWord->word,
                'testQuestionCount' => $testQuestionCount,
                'trueAnswerCount' => $trueAnswerCount,
                'falseAnswerCount' => $falseAnswerCount 
            ];
        }
        
        $wordViewCount = $word->wordView->count();

        return view('word.show', compact('word', 'results', 'wordViewCount'));
    }
}
