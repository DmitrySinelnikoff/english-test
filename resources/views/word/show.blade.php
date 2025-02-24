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
        @if(auth()->check() && auth::user()->role == app\enums\RoleEnum::Admin)
            <form action="{{ route('word.delete', $word) }}" method="post">
                @csrf
                @method('delete')
                <button type="submit" class="submitButton">
                    Удалить
                </button>
            </form>
        @endif
    </div>
    <div class="substrate">
        <h1>Статистика всех тестов</div=>
        <div class="scroll_container">
            @foreach($results as $key => $result)
                <div class="card2">
                    <h1>{{$result['englishWord']}} - {{$result['russianWord']}}</h1>
                    Всего: <span class="round" id="test-question-count-{{$key}}">{{$result['testQuestionCount']}}</span><br>
                    Правильных: <span class="round green" id="true-answer-count-{{$key}}">{{$result['trueAnswerCount']}}</span><br>
                    Неправльных: <span class="round red" id="false-answer-count-{{$key}}">{{$result['falseAnswerCount']}}</span><br>
                    <div class="answer-graph-container">
                        <div class="answer green" id="true-answer-{{$key}}"></div>
                        <div class="answer blue" id="none-answer-{{$key}}"></div>
                        <div class="answer red" id="false-answer-{{$key}}"></div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <script>
        for(let i = 0; i < {{ count($results) }}; i++) {
            const trueAnswer = document.getElementById('true-answer-' + i);
            const falseAnswer = document.getElementById('false-answer-' + i)
            const noneAnswer = document.getElementById('none-answer-' + i)

            const testQuestionCount = document.getElementById('test-question-count-' + i).textContent;
            const trueAnswerCount = document.getElementById('true-answer-count-' + i).textContent;
            const falseAnswerCount = document.getElementById('false-answer-count-' + i).textContent;
            if(testQuestionCount == 0) {
                trueAnswer.style.width = 33.3333 + '%';
                falseAnswer.style.width = 33.3333 + '%';
                noneAnswer.style.width = 33.3333 + '%';
                continue;
            }
    
            const trueRes = trueAnswerCount / testQuestionCount * 100;
            trueAnswer.style.width = trueRes + '%';

            const falseRes = falseAnswerCount / testQuestionCount * 100;
            falseAnswer.style.width = falseRes + '%'; 

            const noneRes = (testQuestionCount - trueAnswerCount - falseAnswerCount) * 100 / testQuestionCount;
            noneAnswer.style.width = noneRes + '%';
        }
    </script>
@endsection