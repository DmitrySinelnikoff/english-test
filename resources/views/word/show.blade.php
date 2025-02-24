@extends('layouts.dashboard')

@section('title')
    Слово - {{ $word->word }}
@endsection

@section('content')
    <div class="substrate">
        <div class="wordHead">
            {{ $word->word }} - {{ $word->transcription }}
        </div>
        <h1>Перевод</h1>
        <div class="scroll_container">
            @foreach ($word->translate as $translate)
                <div class="card2">{{ $translate->word }}</div>
            @endforeach
        </div>
        <h1>Тег</h1>
        <div class="scroll_container">
            @foreach ($word->tag as $tag)
                <div class="card2">{{ $tag->name }}</div>
            @endforeach
        </div>
        @if(auth()->check() && Auth::user()->role == App\Enums\RoleEnum::Admin)
            <form action="{{ route('word.delete', $word) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="submitButton">
                    Удалить
                </button>
            </form>
        @endif
    </div>
    <div class="substrate">
        <div class="scroll_container">
            @foreach($results as $key => $result)
                <div class="card2">
                    <h1>{{$result['englishWord']}} - {{$result['russianWord']}}</h1>
                    <span>Всего: {{$result['testQuestionCount']}}</span>
                    <span>Правильных: {{$result['trueAnswerCount']}}</span>
                    <span>Неправльных: {{$result['falseAnswerCount']}}</span>
                </div>
            @endforeach
        </div>
    </div>
@endsection