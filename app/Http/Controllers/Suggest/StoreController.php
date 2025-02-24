<?php

namespace App\Http\Controllers\Suggest;

use App\Http\Controllers\Controller;
use App\Http\Requests\Suggest\StoreRequest;
use App\Models\EnglishWord;
use App\Models\RussianWord;
use App\Models\Tag;
use Illuminate\Support\Facades\DB;

class StoreController extends Controller
{
    public function index(StoreRequest $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->validated();
            $englishWord = EnglishWord::firstOrCreate(['word'=>$data['word'], 'transcription'=>$data['transcription']]);

            foreach($data['tag_ids'] as $tag)
            {
                if(!is_numeric($tag)) {
                    $tagId = Tag::firstOrCreate(['name'=>$tag]);
                    $tag = $tagId->id;
                }
                $englishWord->tag()->attach($tag);
            }

            $translateWord = $data['translate_id'];
            if(!is_numeric($translateWord)) {
                $russiamWordId = RussianWord::firstOrCreate(['word'=>$translateWord]);
                $translateWord = $russiamWordId->id;
            }
            $englishWord->translate()->attach($translateWord);

            DB::commit();
        } catch(\Exception $exeption) {
            DB::rollBack();
            abort(500);
        }
        return redirect()->route('main.index');
    }
}
