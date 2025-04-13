<?php

namespace App\Http\Controllers;

use App\Models\EnglishRussianWord;
use App\Models\EnglishWord;
use App\Models\PartOfSpeech;
use Illuminate\Http\Request;

class PartOfSpeechController extends Controller
{
    public function index(Request $request)
    {
        $partsOfSpeech = PartOfSpeech::all();
        return view('part_of_speech.index', compact('partsOfSpeech'));
    }

    public function show(PartOfSpeech $partOfSpeech)
    {
        $words = EnglishRussianWord::where('part_of_speech_id', $partOfSpeech->id)->inRandomOrder()->limit(30)->get();
        return view('part_of_speech.show', compact('partOfSpeech', 'words'));
    }
}
