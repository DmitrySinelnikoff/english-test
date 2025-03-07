<?php

namespace App\Http\Controllers;

use App\Enums\StatusEnum;
use Illuminate\Http\Request;
use App\Models\EnglishWord;
use App\Models\TestQuestion;
use App\Models\WordView;

class WordController extends Controller
{
    public function index()
    {
        $words = EnglishWord::where('status', StatusEnum::Approved)->paginate(81);
        return view('word.index', compact('words'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(EnglishWord $word)
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

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy(EnglishWord $word)
    {
        $word->delete();
        return redirect()->route('word.index');
    }
}
