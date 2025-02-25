@extends('layouts.dashboard')

@section('title')
    Все слова
@endsection

@section('content')
    @foreach ($words as $word)
        <div class="word-container">
            <a href="{{ route('word.show', ['word' => $word]) }}">
                <div class="word-card">
                    <span>
                        {{ $word->word }}
                    </span>
                    <br>
                    <span>
                        {{ \Illuminate\Support\Str::limit($word->translate->first()->word, 10) }}
                    </span>
                </div>
            </a>
        </div>
    @endforeach
    <div>
        {{ $words->links('pagination::bootstrap-4') }}
    </div>
@endsection
