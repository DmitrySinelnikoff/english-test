<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\EnglishWord;
use App\Models\RussianWord;
use App\Models\Tag;

class WordTagController extends Controller
{
    public function index($tag)
    {
        $word = Tag::where('id', $tag)->first()->words->random(1)->first();
        $translate = EnglishWord::where("word", $word->word)->first()->translate->first();
        $falseVariants = RussianWord::all()->where('word', '<>', $translate)->random(3);

        $index = rand(0, 2);
        $j = 0;
        for($i = 0; $i < 4; $i++) {
            if($i == $index) {
                $allVariants[$index] = $translate;
            } else {
                $allVariants[$i] = $falseVariants[$j];
                $j++;
            }
        }

        return ['original' => $word, 'translate' => $translate, 'variants' => $allVariants];
    }
}
