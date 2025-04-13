@extends('layouts.dashboard')

@section('title')
    Ваши тесты
@endsection

@section('content')
    @if($tests->count() == 0)
        <div class="substrate" style="margin-top: 20%">
            <div class="center-container">
                <h1>Данные не найдены</h1>
            </div>
        </div>
    @else
        <div class="test-card-container">
            @foreach ($tests as $index => $test)
                <a href="{{ route('wordtest.show', ['test' => $test, 'index' => 1]) }}">
                    <div class="test-card">
                        <div class="center-container">
                            <div class="headtest-card">#{{ $test->id }}</div>
                        </div>
                        <div class="center-container">
                            <div class="headtest-card">{{ $test->name }}</div>
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
    @endif
    <div>
        {{ $tests->links('pagination::bootstrap-4') }}
    </div>
@endsection
