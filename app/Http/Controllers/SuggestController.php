<?php

namespace App\Http\Controllers;

use App\Http\Requests\SuggestRequest;
use App\Models\EnglishRussianWord;
use App\Models\EnglishWord;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SuggestController extends Controller
{
    public function index()
    {
        $data = EnglishWord::where('word_status_id', 1)->get();
        return view('suggest.index', ['data'=>$data]);
    }

    public function create()
    {
        return view(view: 'suggest.create');
    }

    public function store(SuggestRequest $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->validated();
            $englishWord = EnglishWord::firstOrCreate(['word'=>$data['word'], 'transcription'=>$data['transcription'], 'word_status_id' => 1]);

            foreach($data['tag_ids'] as $tag)
            {
                if(!is_numeric($tag)) {
                    $tagId = Tag::firstOrCreate(['name'=>$tag]);
                    $tag = $tagId->id;
                }
                $englishWord->tag()->attach($tag);
            }

            $translateWord = $data['translate_id'];
            EnglishRussianWord::create([
                'english_word_id' => $englishWord->id,
                'russian_word_id' => $translateWord,
                'part_of_speech_id' => $data['part_of_speech_id']
            ]);

            DB::commit();
        } catch(\Exception $exeption) {
            DB::rollBack();
            abort(500);
        }
        return redirect()->route('home.show');
    }

    public function destroy(EnglishWord $word)
    {
        try {
            DB::beginTransaction();

            foreach($word->tag as $tag) {
                if($tag->wordsAll->count() == 1 && $tag->wordsAll->first()->where('name', $word->name) != null) {
                    $tag->delete();
                }
            }

            foreach($word->translate as $translate) {
                if($translate->original->count() == 1 && $translate->original->first()->where('name', $word->name) != null) {
                    $translate->delete();
                }
            }

            $word->delete();

            DB::commit();
        } catch(\Exception $exeption) {
            DB::rollBack();
            dd($exeption);
            abort(500);
        }
        return redirect()->route('suggest.index');
    }

    public function approved(Request $request, EnglishWord $word)
    {
        $word->word_status_id = 2;
        $word->save();
        return redirect()->route('suggest.index');
    }
}
