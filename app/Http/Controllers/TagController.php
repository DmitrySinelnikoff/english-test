<?php

namespace App\Http\Controllers;

use App\Http\Requests\TagRequest;
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
        return view('tags.create');
    }
    
    public function store(TagRequest $request)
    {
        $data = $request->validated();
        Tag::firstOrCreate($data);
        return redirect()->route('tags.index');
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

    public function edit(Tag $tag)
    {
        return view('tags.edit', compact('tag'));
    }

    public function update(TagRequest $request, Tag $tag)
    {
        $data = $request->validated();
        $tag->update($data);
        return redirect()->route('tags.show', ['tag' => $tag]);
    }

    public function destroy(Tag $tag)
    {
        $tag->delete();
        return redirect()->route('tags.index');
    }
}