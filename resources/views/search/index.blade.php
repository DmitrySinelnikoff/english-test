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
        <a href="{{ route('word.show', ['word' => $englishWord]) }}">
            <div class="card-gray">
                <div>{{ $englishWord->word }}</div>
            </div>
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
            <div class="card-gray">
                <div>{{ $russianWord->word }}</div>
            </div>
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
        <a href="{{ route('tags.index', ['tag' => $tag]) }}">
            <div class="card-gray">
                <div>{{ $tag->name }}</div>
            </div>
        </a>
        @endforeach
    </div>
</div>

@endsection
