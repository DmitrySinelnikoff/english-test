@extends('layouts.dashboard')

@section('title')
    {{ $partOfSpeech->name }}
@endsection

@section('content')
    <div class="word-head-big">
        <div class="center-container">
            {{ $partOfSpeech->name }}
        </div>
    </div>
    <div class="substrate">
        <h1>Описание</h1>
        <div>{{ $partOfSpeech->description }}</div>
    </div>
    <div class="substrate">
        <h1>Слова</h1>
        <div class="scroll-container">
            @if($words->count() == 0)
                <div>Данные не найдены</div>
            @else
                @foreach ($words as $word)
                    <a href="{{ route('word.show', $word->englishWord) }}" class="card-gray">
                        <div>{{ $word->englishWord->word }}</div>
                    </a>
                @endforeach
            @endif
        </div>
    </div>
    <div class="substrate">
        <div class="statistic-card-container">
            <div class="statistic-card">Создание: {{ $partOfSpeech->created_at ?? 'Нет данных' }}</div>
            <div class="statistic-card">Изменение: {{ $partOfSpeech->updated_at ?? 'Нет данных' }}</div>
        </div>
    </div>
@endsection