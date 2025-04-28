@extends('layouts.dashboard')

@section('title')
    Все русские слова
@endsection

@section('content')
    <div class="cards-container">
            @foreach ($words as $word)
                <a href="{{ route('russian.word.show', ['word' => $word]) }}">
                    <div class="card">
                        <div class="image-container">
                            <img src="{{ asset('img/words/' . ($word->englishRussian->first()->image_path ?? 'word-pattern.jpg')) }}" alt="Изображение не найдено">
                        </div>
                        <div class="text-string">
                            {{ \Illuminate\Support\Str::limit($word->word, 25) }}
                        </div>
                        <div class="text-string">
                            {{ \Illuminate\Support\Str::limit($word->original->first()->word ?? 'Нет данных', 25) }}
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
        <div>
            {{ $words->links('pagination::bootstrap-4') }}
        </div>
        @if(auth()->check() && Auth::user()->user_role_id == 2)
            <a class="add-button" href="{{ route('russian.word.create') }}">+</a>
        @endif
@endsection
