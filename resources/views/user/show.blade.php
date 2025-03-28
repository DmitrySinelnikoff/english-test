@extends('layouts.dashboard')

@section('title')
    {{ $user->name }}
@endsection

@section('content')
<div class="substrate">
    <div class="information-container">Имя: {{ $user->name }}</div>
    <div class="information-container">Почта: {{ $user->email }}</div>
    <div class="information-container">Роль: {{ $user->user_role_id == 1 ? 'Пользователь' : 'Администратор'}}</div>
    <div class="information-container">Очки: {{ $user->userSumResult() }}</div>
    <div class="information-container">Кол-во пройденных тестов: {{ $user->userTestCount() }}</div>
    <div class="information-container">Правильных ответов: {{ $user->trueAnswerPercente() }}%</div>
</div>
@if (Auth::user()->id == $user->id)    
    <div class="substrate">
        <form action="{{ route('user.delete') }}" method="post" class="button-form" onsubmit="return validateDelete()">
            @csrf
            @method('delete')
            <button type="submit" class="submit-button">
                Удалить
            </button>
        </form>
        <form action="{{ route('user.edit') }}" method="get" class="button-form">
            <button type="submit" class="submit-button">
                Изменить 
            </button>
        </form>
    </div>
@endif
<div class="substrate">
    <h1>Последние тесты пользователя</h1>
    <div class="scroll-container" id="scroll-last-tests">
        @foreach ($tests as $index => $test)
            <a href="{{ route('wordtest.show', ['test' => $test, 'index' => 1]) }}">
                <div class="test-card">
                    <div class="center-container">
                        <div class="headtest-card">Тест №{{ $test->id }}</div>
                    </div>
                    @foreach($test->questions as $question)
                        <div class="concret-wordtest-card">
                            @if($question->result == 2)
                                🟢
                            @elseif($question->result == 1)
                                🔴
                            @else
                                🔵
                            @endif
                            {{ $question->wordCombination->englishWord->word }}
                        </div>
                    @endforeach
                </div>
            </a>
        @endforeach
    </div>
</div>
<div class="substrate">
    <h1>Последние неправильные ответы</h1>
    <div class="scroll-container" id="scroll-bad-answer">
        @foreach ($tests as $test)
            @foreach ($test->questions as $question)
                @if ($question->result == 1)
                <a href="{{ route('word.show', ['word' => $question->wordCombination->englishWord]) }}">
                    <div class="card-gray">
                        {{ $question->wordCombination->englishWord->word }}
                    </div> 
                </a>
                @endif 
            @endforeach
        @endforeach    
    </div>   
</div>
<script>
    function checkAndUpdateContent(element) {
        let content = element.innerHTML;
        if (content.trim() === '') element.innerHTML = 'Данные не найдены';
    }

    checkAndUpdateContent(document.getElementById('scroll-bad-answer'));
    checkAndUpdateContent(document.getElementById('scroll-last-tests'));
</script>
@endsection
