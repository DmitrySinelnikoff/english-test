<?php

namespace App\Http\Controllers\WordTest;

use App\Http\Controllers\Controller;
use App\Models\EnglishWord;
use App\Models\RussianWord;
use App\Models\Tag;
use App\Models\Test;
use App\Models\TestQuestion;
use App\Models\TestWord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
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
}