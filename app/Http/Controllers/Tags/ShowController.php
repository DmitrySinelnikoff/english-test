<?php

namespace App\Http\Controllers\Tags;

use App\Http\Controllers\Controller;
use App\Models\Tag;

class ShowController extends Controller
{
    public function index(Tag $tag)
    {
        $examplesTag = $tag->words;

        $wordsCount = $examplesTag->count();
        if($wordsCount >= 20) {
            $examplesTag = $examplesTag->random(20);
        } else {
            $examplesTag = $examplesTag->random($wordsCount);
        }

        return view('tags.show', compact('tag', 'examplesTag'));
    }
}
