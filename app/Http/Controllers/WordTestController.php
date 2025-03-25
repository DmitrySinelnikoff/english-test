<?php

namespace App\Http\Controllers;

use App\Models\EnglishWord;
use App\Models\RussianWord;
use App\Models\Tag;
use App\Models\Test;
use App\Models\TestQuestion;
use App\Models\TestWord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WordTestController extends Controller
{
    public function index(Request $request)
    {
        try {
            DB::beginTransaction();

            $tagId = $request->tagId;
            
            $test = Test::create([
                "user_id" => $request->user()->id,
            ]);

            for($questionsIndex = 0; $questionsIndex < 10; $questionsIndex++) {
                $word = Tag::select('id')->where('id', $tagId)->first()->words->random(1)->first();
                
                $question = TestQuestion::create([
                    "result" => 0,
                    "test_id" => $test->id,
                    "english_russian_word_id" => $word->id
                ]);

                for($falseVariantIndex = 0; $falseVariantIndex < 3; $falseVariantIndex++) {
                    $translate = EnglishWord::select('id')->where("word", $word->word)->first()->translate->first();
                    $falseVariants = RussianWord::select('id')->where('word', '<>', $translate)->inRandomOrder()->first();
                    TestWord::create([
                        "test_question_id" => $question->id,
                        "russian_word_id" => $falseVariants->id
                    ]);
                }
            }

            DB::commit();
        } catch(\Exception $exeption) {
            DB::rollBack();
            abort(500);
        }
        
        return redirect()->route('wordtest.show', ["test" => $test, "index" => 1]);
    }

    public function show(Test $test, int $question)
    {
        if(Auth::user()->id != $test->user_id) {
            abort(500);
        }
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

    public function list(Test $test)
    {
        $tests = Test::where("user_id", Auth::user()->id)->orderBy("id", "desc")->paginate(12);
        return view('wordtest.list', compact('tests'));
    }

    public function result(Test $test)
    {
        $results = TestQuestion::where('test_id', $test->id)->get();
        $trueAnswerCount = $results->where('result', 2)->count(); 
        return view('wordtest.result', ['results' => $results, 'trueAnswerCount' => $trueAnswerCount]);
    }

    public function check(Request $request)
    {
        $question = TestQuestion::where("id", $request->question)->first();
        $question->update([
            "result" => $request->otv == 1 ? 2:1
        ]);

        $nextPage = strval($request->thisQuestionPage + 1);
        return redirect("/wordtest/show/{$request->testID}/{$nextPage}");
    }
}
