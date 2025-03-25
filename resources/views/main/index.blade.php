@extends('layouts.dashboard')

@section('title')
    Главная
@endsection

@section('content')
<div class="substrate">
    <h1 class="">Категории</h1>
    <div class="scroll-container">
        @foreach ($tags as $tag)
        <a href="{{ route('tags.show', ['tag' => $tag]) }}">
            @if ($tag->words->count() > 0)
                <div class="card-gray">
                    <div>{{ $tag->name }}</div>
                    <div>{{ $tag->words_count }}</div>
                </div>
            @endif
        </a>
        @endforeach
    </div>
</div>

<div class="substrate">
    <h1 class="">Новые пользователи</h1>
    <div class="scroll-container">
        @foreach ($users as $user)
        <a href="{{ route('user.show', ['user' => $user]) }}">
            <div class="card-gray">
                <div>{{ $user->name }}</div>
            </div>
        </a>
        @endforeach
    </div>
</div>

<div class="substrate">
    <h1 class="">Популярные слова</h1>
    <div class="scroll-container">
        @foreach ($views as $view)
        <a href="{{ route('word.show', ['word' => $view]) }}">
            <div class="card-gray">
                <div>{{ $view->word }}</div>
            </div>
        </a>
        @endforeach
    </div>
</div>

@auth
    @if($viewed->count())
        <div class="substrate">
            <h1 class="">Ваши просмотры</h1>
            <div class="scroll-container">
                @foreach ($viewed as $view)
                <a href="{{ route('word.show', ['word' => $view]) }}">
                    <div class="card-gray">
                        <div>{{ $view->word }}</div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    @endif
@endauth

@endsection
