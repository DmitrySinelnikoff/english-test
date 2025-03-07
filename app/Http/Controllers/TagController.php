<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::all()->paginate(81);
        return view('tags.index', compact('tags'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Tag $tag)
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

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
