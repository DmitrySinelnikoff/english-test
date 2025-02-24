@extends('layouts.dashboard')

@section('title')
    Главная
@endsection

@section('content')
<h1 class="">Категории</h1>
<div class="scroll_container">
    @foreach ($tags as $tag)
    <a href="{{ route('tags.show', ['tag' => $tag]) }}">
        @if ($tag->words->count() > 0)
            <div class="card">
                <div>{{ $tag->name }}</div>
                <div>{{ $tag->words_count }}</div>
            </div>
        @endif
    </a>
    @endforeach
</div>

<h1 class="">Популярные слова</h1>
<div class="scroll_container">
    @foreach ($views as $view)
    <a href="{{ route('word.show', ['word' => $view]) }}">
        <div class="card">
            <div>{{ $view->word }}</div>
        </div>
    </a>
    @endforeach
</div>

@auth
    @if($viewed->count())
    <h1 class="">Ваши просмотры</h1>
    <div class="scroll_container">
        @foreach ($viewed as $view)
        <a href="{{ route('word.show', ['word' => $view]) }}">
            <div class="card">
                <div>{{ $view->word }}</div>
            </div>
        </a>
        @endforeach
    </div>
    @endif
@endauth
@endsection
