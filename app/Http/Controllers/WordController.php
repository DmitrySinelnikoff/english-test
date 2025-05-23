<?php

namespace App\Http\Controllers;

use App\Enums\LetterEnum;
use App\Http\Requests\AddTranslateRequest;
use App\Http\Requests\UpdateWordRequest;
use App\Http\Requests\WordRequest;
use App\Models\EnglishRussianWord;
use App\Models\PartOfSpeech;
use App\Models\RussianWord;
use App\Models\Tag;
use App\Models\EnglishWord;
use App\Models\TestQuestion;
use App\Models\WordView;
use Illuminate\Http\Request;
use DB;

class WordController extends Controller
{
    public function index(Request $request)
    {
        $words = EnglishWord::where('word_status_id', 2);

        if($request->has('time')){
            switch($request->get('time')){
                case 'old':
                    $words = $words->orderBy('id', 'asc');
                    break;
                case 'new':
                    $words = $words->orderBy('id', 'desc');
                    break;
            }
        }

        if($request->has('letter')){
            $words = $words->where('word', 'LIKE', $request->get('letter') . '%');
        }

        $words = $words->paginate(10)->appends(request()->query());

        $letters = LetterEnum::cases();

        if(isset($_GET['page'])) $_GET['page'] = 1;

        return view('word.index', compact('words', 'letters'));
    }

    public function create()
    {
        return view('word.create');
    }

    public function store(WordRequest $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->validated();
            $englishWord = EnglishWord::firstOrCreate(['word'=>$data['word'], 'transcription'=>$data['transcription'], 'word_status_id' => 2]);

            foreach($data['tag_ids'] as $tag)
            {
                if(!is_numeric($tag)) {
                    $tagId = Tag::firstOrCreate(['name'=>$tag]);
                    $tag = $tagId->id;
                }
                $englishWord->tag()->attach($tag);
            }

            $fileName = isset($data['picture']) ? time() . mt_rand() . '.' . $data['picture']->extension() : NULL;
            if($fileName != null) {
                $data['picture']->move(public_path('img/words'), $fileName);
            }

            $translateWord = $data['translate_id'];
            EnglishRussianWord::create([
                'english_word_id' => $englishWord->id,
                'russian_word_id' => $translateWord,
                'part_of_speech_id' => $data['part_of_speech_id'],
                'image_path' => $fileName
            ]);

            DB::commit();
        } catch(\Exception $exeption) {
            DB::rollBack();
            abort(500);
        }
        return redirect()->route('word.index');
    }

    public function show(EnglishWord $word)
    {
        if(auth()->check()){
            WordView::createViewLog($word);
        }

        $results = [];
        $translates = $word->englishRussian()->get();
        $partOfSpeech = collect();
        $part = new PartOfSpeech();
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
            $partOfSpeech->push($part->select('name')->where('id', $translate->part_of_speech_id)->get()->first()->name);
        }
        
        $wordViewCount = $word->wordView->count();

        return view('word.show', compact('word', 'results' , 'partOfSpeech', 'wordViewCount'));
    }

    public function edit(EnglishWord $word)
    {
        $wordID = $word->id;
        $selectTags = $word->tag;
        $selectedTagsId = collect();
        foreach($selectTags as $tag)
        {
            $selectedTagsId->push($tag->id);
        }

        $selectWord = $word->translate;
        $selectedWordsId = collect();
        foreach($selectWord as $word)
        {
            $selectedWordsId->push($word->id);
        }

        $selectSpeech = $word->englishRussian;
        $selectSpeechId = collect();
        foreach($selectSpeech as $speech)
        {
            $selectSpeechId->push($speech->id);
        }

        $tags = Tag::all();
        $russianWords = RussianWord::all();
        $partsOfSpeech = PartOfSpeech::all();
        $word = EnglishWord::where('id', $wordID)->first();
        return view('word.edit', compact('word', 'tags', 'russianWords', 'partsOfSpeech', 'selectedTagsId', 'selectedWordsId', 'selectSpeechId'));
    }

    public function update(UpdateWordRequest $request, EnglishWord $word)
    {
        $data = $request->validated();
        $selectedTags = $data['tag_ids'];
        $currentTags = $word->tag->pluck('id')->toArray();

        $word->update([
            'word' => $data['word'],
            'transcription' => $data['word'],
        ]);

        $attach = array_diff($selectedTags, $currentTags);
        $detach = array_diff($currentTags, $selectedTags);
        if($attach != null){
            $word->tag()->attach($attach);
        }
        if($detach != null){
            $word->tag()->detach($detach);
        }

        return redirect()->route('word.show', compact('word'));
    }

    public function destroy(EnglishWord $word)
    {
        $word->delete();
        return redirect()->route('word.index');
    }

    public function addTranslate(EnglishWord $word)
    {
        return view('word.add-translate', compact('word'));
    }

    public function storeTranslate(AddTranslateRequest $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->validated();

            $fileName = isset($data['picture']) ? time() . mt_rand() . '.' . $data['picture']->extension() : NULL;
            if($fileName != null) {
                $data['picture']->move(public_path('img/words'), $fileName);
            }

            $translateWord = $data['translate_id'];
            EnglishRussianWord::create([
                'english_word_id' => $data['english_id'],
                'russian_word_id' => $data['translate_id'],
                'part_of_speech_id' => $data['part_of_speech_id'],
                'image_path' => $fileName
            ]);

            DB::commit();
        } catch(\Exception $exeption) {
            DB::rollBack();
            abort(500);
        }
        $word = EnglishWord::where('id', $data['english_id'])->first();
        return redirect()->route('word.show', compact('word'));
    }

    public function destroyTranslate(Request $request, EnglishRussianWord $word)
    {
        try {
            $word->delete();
        } catch (\Exception $e) {
            \Log::error('Ошибка удаления: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Не удалось удалить запись']);
        }
        return redirect($request->header('referer'));
    }
}
