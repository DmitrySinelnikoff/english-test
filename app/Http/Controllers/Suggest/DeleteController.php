<?php

namespace App\Http\Controllers\Suggest;

use App\Http\Controllers\Controller;
use App\Models\EnglishWord;
use App\Models\RussianWord;
use App\Models\Tag;
use Illuminate\Support\Facades\DB;

class DeleteController extends Controller
{
    public function index(EnglishWord $word)
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
}
