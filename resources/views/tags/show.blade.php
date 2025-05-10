@extends('layouts.dashboard')

@section('title')
    Тег - {{ $tag->name }}
@endsection

@section('content')
    <div class="word-head-big">
        <div class="center-container">{{ $tag->name }}</div>
    </div>
    @if(auth()->check() && auth()->user()->user_role_id == 2)
        <div class="substrate">
            <div class="center-container small-gap">
                <form action="{{ route('tags.delete', $tag) }}" method="post" class="button-form" onsubmit="return validateDelete()">
                    @csrf
                    @method('delete')
                    <button type="submit" class="submit-button">Удалить</button>
                </form>
                <form action="{{ route('tags.edit', $tag) }}" method="get" class="button-form">
                    @csrf
                    <button type="submit" class="submit-button">Изменить</button>
                </form>
            </div>
        </div>
    @endif
    @if($tag->words->count() > 9)
        <div class="substrate">
            <div class="button-group">
                <form action="{{ route('wordtest.index', ['tagId' => $tag]) }}" method="POST">
                    @csrf
                    <button type="submit" class="submit-button">
                        Тест английских слов
                    </button>
                </form>
                <form action="{{ route('wordtest.index.russian', ['tagId' => $tag]) }}" method="POST">
                    @csrf
                    <button type="submit" class="submit-button">
                        Тест русских слов
                    </button>
                </form>
                <form action="{{ route('wordtest.index.transcription', ['tagId' => $tag]) }}" method="POST">
                    @csrf
                    <button type="submit" class="submit-button">
                        Тест транскрипций
                    </button>
                </form>
                <form action="{{ route('wordtest.index.photo', ['tagId' => $tag]) }}" method="POST">
                    @csrf
                    <button type="submit" class="submit-button">
                        Тест фотографий
                    </button>
                </form>
                <form action="{{ route('wordtest.index.part', ['tagId' => $tag]) }}" method="POST">
                    @csrf
                    <button type="submit" class="submit-button">
                        Тест частей речи
                    </button>
                </form>
            </div>
        </div>
    @endif
    <div class="substrate">
        <h1>Описание</h1>
        <div class="text">{{ $tag->description }}</div>
    </div>
    @if($examplesTag->count())
        <div class="substrate">
            <h1>Слова из категории</h1>
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
    <div class="substrate">
        <h1>Кол-во: {{ $tag->words->count() }}</h1>
    </div>
    <div class="substrate">
        <h1>Создание: {{ $tag->created_at ?? 'Нет данных' }}</h1>
    </div>
    <script>
        function validateDelete() {
            if(confirm('Вы хотите удалить этот тег?')) {
                return true
            } else {
                return false
            }
        }
    </script>
@endsection
