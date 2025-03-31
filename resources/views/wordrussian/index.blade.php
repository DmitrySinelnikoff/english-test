@extends('layouts.dashboard')

@section('title')
    Все русские слова
@endsection

@section('content')
        @foreach ($words as $word)
            <div class="word-container">
                <a href="{{ route('russian.word.show', ['word' => $word]) }}">
                    <div class="word-card">
                        <span>
                            {{ \Illuminate\Support\Str::limit($word->word, 10) }}
                        </span>
                        <br>
                        <span>
                            {{ \Illuminate\Support\Str::limit($word->original->first()->word ?? 'Нет данных', 10) }}
                        </span>
                    </div>
                </a>
            </div>
        @endforeach
        <div>
            {{ $words->links('pagination::bootstrap-4') }}
        </div>
        @if(auth()->check() && Auth::user()->user_role_id == 2)
            <a class="add-button" href="{{ route('russian.word.create') }}">+</a>
        @endif
@endsection
