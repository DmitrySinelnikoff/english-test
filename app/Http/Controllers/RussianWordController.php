<?php

namespace App\Http\Controllers;

use App\Http\Requests\RussianWordRequest;
use App\Models\RussianWord;
use App\Enums\RussianLetterEnum;
use Illuminate\Http\Request;

class RussianWordController extends Controller
{
    public function index(Request $request)
    {
        $words = new RussianWord();

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

        $letters = RussianLetterEnum::cases();

        if(isset($_GET['page'])) $_GET['page'] = 1;

        return view('wordrussian.index', compact('words', 'letters'));
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
