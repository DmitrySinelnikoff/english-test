@extends('layouts.dashboard')

@section('title')
    Слово - {{ $word->word }}
@endsection

@section('content')
    <div class="word-head-big">
        <div class="center-container">
            {{ $word->word }}
        </div>
    </div>
    @if(auth()->check() && auth()->user()->user_role_id == 2)
        <div class="substrate">
            <form action="{{ route('word.delete', $word) }}" method="post" class="button-form" onsubmit="return validateDelete()">
                @csrf
                @method('delete')
                <button type="submit" class="submit-button">
                    Удалить
                </button>
            </form>
            <form action="{{ route('word.edit', $word) }}" method="get" class="button-form">
                @csrf
                <button type="submit" class="submit-button">
                   Изменить 
                </button>
            </form>
        </div>
    @endif
    <div class="substrate">
        <h1>Транскрипция: {{ $word->transcription }}</h1>
    </div>
    <div class="substrate">
        <h1>Перевод</h1>
        <div class="scroll-container">
            @foreach ($word->translate as $key => $translate)
                <a href="{{ route('russian.word.show', $translate) }}" class="card-gray">
                    <div>{{ $translate->word }}</div>
                    <div>{{ $partOfSpeech[$key] }}</div>
                </a>
            @endforeach
        </div>
    </div>
    <div class="substrate">
        <h1>Категории</h1>
        <div class="scroll-container">
            @foreach ($word->tag as $tag)
                <a href="{{ route('tags.show', $tag) }}" class="card-gray">{{ $tag->name }}</a>
            @endforeach
        </div>
    </div>
    <div class="substrate">
        <h1>Статистика всех тестов</div=>
        <div class="scroll-container">
            @foreach($results as $key => $result)
                <div class="card-gray">
                    <h1>{{$result['englishWord']}} - {{$result['russianWord']}}</h1>
                    <div class="margin-medium">Всего: <span class="round" id="test-question-count-{{$key}}">{{$result['testQuestionCount']}}</span></div>
                    <div class="margin-medium">Правильных: <span class="round green" id="true-answer-count-{{$key}}">{{$result['trueAnswerCount']}}</span></div>
                    <div class="margin-medium">Неправльных: <span class="round red" id="false-answer-count-{{$key}}">{{$result['falseAnswerCount']}}</span></div>
                    <div class="answer-graph-container">
                        <div class="answer green" id="true-answer-{{$key}}" title="Правильных ответов"></div>
                        <div class="answer blue" id="none-answer-{{$key}}" title="Без ответа"></div>
                        <div class="answer red" id="false-answer-{{$key}}" title="Неправильных ответов"></div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="substrate">
        <h1>Просмотров у слова: {{ $wordViewCount }}</h1>
    </div>
    <div class="substrate">
        <div class="statistic-card-container">
            <div class="statistic-card">Создание: {{ $word->created_at ?? 'Нет данных' }}</div>
            <div class="statistic-card">Изменение: {{ $word->updated_at ?? 'Нет данных' }}</div>
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

        function validateDelete() {
            if(confirm('Вы хотите удалить это слово?')) {
                return true
            } else {
                return false
            }
        }
    </script>
@endsection