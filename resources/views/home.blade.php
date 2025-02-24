@extends('layouts.dashboard')

@section('content')
<div class="substrate">
    <div class="informationContainer">Имя: {{ Auth::user()->name }}</div>
    <div class="informationContainer">Почта: {{ Auth::user()->email }}</div>
    <div class="informationContainer">Роль: {{ Auth::user()->role == App\Enums\RoleEnum::User ? 'Пользователь' : 'Администратор'}}</div>
    <div class="informationContainer">Очки: {{ Auth::user()->userSumResult() }}</div>
    <div class="informationContainer">Кол-во пройденных тестов: {{ Auth::user()->userTestCount() }}</div>
    <div class="informationContainer">Правильных ответов: {{ Auth::user()->trueAnswerPercente() }}%</div>
</div>
<div class="substrate">
    <h1>Последние тесты пользователя</h1>
    @if($tests->count() == 0)
        Данные не найдены
    @else
        <div class="scroll_container">
            @foreach ($tests as $index => $test)
                    <a href="{{ route('wordtest.show', ['test' => $test, 'index' => 1]) }}">
                        <div class="testCard">
                            <div class="centerContainer">
                                <div class="headTestCard">Тест №{{ $test->id }}</div>
                            </div>
                            @foreach($test->questions as $question)
                                <div class="concretWordTestCard">
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
    @endif
</div>
@endsection
