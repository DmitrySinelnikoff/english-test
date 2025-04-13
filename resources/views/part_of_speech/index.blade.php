@extends('layouts.dashboard')

@section('title')
    Части речи
@endsection

@section('content')
    @foreach ($partsOfSpeech as $partOfSpeech)
        <div class="word-container">
            <a href="{{ route('part-of-speech.show', ['partOfSpeech' => $partOfSpeech]) }}">
                <div class="word-card">
                    <span>
                        {{ $partOfSpeech->name }}
                    </span>
                </div>
            </a>
        </div>
    @endforeach
@endsection
