<?php

namespace App\Http\Controllers;

use App\Http\Requests\RussianWordRequest;
use App\Models\RussianWord;

class RussianWordController extends Controller
{
    public function index()
    {
        $words = RussianWord::paginate(10);
        return view('wordrussian.index', compact('words'));
    }

    public function create()
    {
        return view('wordrussian.create');
    }

    public function store(RussianWordRequest $request)
    {
        $data = $request->validated();
        RussianWord::firstOrCreate($data);
        return redirect()->route('russian.word.index');
    }

    public function show(RussianWord $word)
    {
        $results = [];
        $translates = $word->original;
        foreach($translates as $key => $translate){
            $results[$key] = [
                'englishWord' => $word->original,
                'russianWord' => $word->word
            ];
        }

        return view('wordrussian.show', compact('word', 'results'));
    }

    public function edit(RussianWord $word)
    {
        return view('wordrussian.edit', compact('word'));
    }

    public function update(RussianWordRequest $request, RussianWord $word)
    {
        $data = $request->validated();
        $word->update($data);
        return redirect()->route('russian.word.show', ['word' => $word]);
    }

    public function destroy(RussianWord $word)
    {
        $word->delete();
        return redirect()->route('russian.word.index');
    }
}
