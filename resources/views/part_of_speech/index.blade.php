@extends('layouts.dashboard')

@section('title')
    Части речи
@endsection

@section('content')
    <div class="cards-container">
        @foreach ($partsOfSpeech as $partOfSpeech)
            <a href="{{ route('part-of-speech.show', ['partOfSpeech' => $partOfSpeech]) }}">
                <div class="card">
                    <img src="{{ asset('img/words/word-pattern.jpg') }}" alt="Ошибка">
                    <div class="text-string">
                        {{ $partOfSpeech->name }}
                    </div>
                </div>
            </a>
        @endforeach
    </div>
@endsection
