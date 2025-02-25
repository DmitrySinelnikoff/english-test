@extends('layouts.dashboard')

@section('title')
   Поиск 
@endsection

@section('content')

<h1 class="">Английские слова по запросу</h1>
@if ($englishWords->count() == 0)
   Данные не найдены 
@endif
<div class="scroll-container">
    @foreach ($englishWords as $englishWord)
    <a href="{{ route('word.show', ['word' => $englishWord]) }}">
        <div class="card">
            <div>{{ $englishWord->word }}</div>
        </div>
    </a>
    @endforeach
</div>

<h1 class="">Русские слова по запросу</h1>
@if ($russianWords->count() == 0)
   Данные не найдены 
@endif
<div class="scroll-container">
    @foreach ($russianWords as $russianWord)
        <div class="card">
            <div>{{ $russianWord->word }}</div>
        </div>
    @endforeach
</div>

<h1 class="">Категории по запросу</h1>
@if ($tags->count() == 0)
   Данные не найдены 
@endif
<div class="scroll-container">
    @foreach ($tags as $tag)
    <a href="{{ route('tags.index', ['tag' => $tag]) }}">
        <div class="card">
            <div>{{ $tag->name }}</div>
        </div>
    </a>
    @endforeach
</div>

@endsection
