@extends('layouts.dashboard')

@section('title')
    Ваши тесты
@endsection

@section('content')
    @if($tests->count() == 0)
        <div class="substrate" style="margin-top: 20%">
            <div class="centerContainer">
                <h1>Данные не найдены</h1>
            </div>
        </div>
    @else
        <div class="testCardContainer">
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
    <div>
        {{ $tests->links('pagination::bootstrap-4') }}
    </div>
@endsection
