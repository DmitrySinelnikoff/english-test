@extends('layouts.dashboard')

@section('title')
   Поиск 
@endsection

@section('content')

<div class="substrate">
    <h1>Английские слова по запросу</h1>
    @if ($englishWords->count() == 0)
       Данные не найдены 
    @endif
    <div class="scroll-container">
        @foreach ($englishWords as $englishWord)
        <a href="{{ route('word.show', ['word' => $englishWord]) }}" class="card-gray">
            {{ $englishWord->word }}
        </a>
        @endforeach
    </div>
</div>

<div class="substrate">
    <h1>Русские слова по запросу</h1>
    @if ($russianWords->count() == 0)
    Данные не найдены 
    @endif
    <div class="scroll-container">
        @foreach ($russianWords as $russianWord)
            <a href="{{ route('russian.word.show', ['word' => $russianWord]) }}" class="card-gray">
                {{ $russianWord->word }}
            </a>
        @endforeach
    </div>
</div>

<div class="substrate">
    <h1>Категории по запросу</h1>
    @if ($tags->count() == 0)
    Данные не найдены 
    @endif
    <div class="scroll-container">
        @foreach ($tags as $tag)
        <a href="{{ route('tags.show', ['tag' => $tag]) }}" class="card-gray">
            {{ $tag->name }}
        </a>
        @endforeach
    </div>
</div>

@endsection
