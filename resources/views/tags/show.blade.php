@extends('layouts.dashboard')

@section('title')
    Тег - {{ $tag->name }}
@endsection

@section('content')
        <div class="word-head-big">
            <div class="center-container">
                {{ $tag->name }} - {{ $tag->words->count() }}
            </div>
        </div>
        @if(auth()->check() && auth()->user()->role == app\enums\RoleEnum::Admin)
            <div class="substrate">
                <form action="#" method="post" class="button-form">
                    @csrf
                    @method('delete')
                    <button type="submit" class="submit-button">Удалить</button>
                </form>
                <form action="{{ route('tags.edit', $tag) }}" method="get" class="button-form">
                    @csrf
                    <button type="submit" class="submit-button">Изменить</button>
                </form>
            </div>
        @endif
        @if($tag->words->count() > 9)
            <div class="substrate">
                <div class="center-container">
                    <form action="{{ route('wordtest.index', ['tagId' => $tag, 'answer' => array()]) }}" method="POST">
                        @csrf
                        <button type="submit" class="submit-button">
                            Пройти тест
                        </button>
                    </form>
                </div>
            </div>
        @endif
        @if($examplesTag->count())
            <div class="substrate">
                <h1>Слова из категории:</h1>
                <div class="scroll-container">
                    @foreach ($examplesTag as $word)
                        <a href="{{ route('word.show', ['word' => $word]) }}">
                            <div class="card-gray">
                                <div>{{ $word->word }}</div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
@endsection
