@extends('layouts.dashboard')

@section('title')
    Тег - {{ $tag->name }}
@endsection

@section('content')
    <div class="substrate">
        <div class="word-head">
            {{ $tag->name }} - {{ $tag->words->count() }}
        </div>
        @if($examplesTag->count())
            <div class="scroll-container">
                @foreach ($examplesTag as $word)
                <a href="{{ route('word.show', ['word' => $word]) }}">
                    <div class="card-gray">
                        <div>{{ $word->word }}</div>
                    </div>
                </a>
                @endforeach
            </div>
        @endif
        @if($tag->words->count() > 9)
            <form action="{{ route('wordtest.index', ['tagId' => $tag, 'answer' => array()]) }}" method="POST">
                @csrf
                <button type="submit" class="submit-button">
                    Пройти тест
                </button>
            </form>
        @endif
    </div>
@endsection
