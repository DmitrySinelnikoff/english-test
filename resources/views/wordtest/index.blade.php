@extends('layouts.dashboard')

@section('title')
    Тест
@endsection

@section('content')
    <script>
        function preventBack() {
            window.history.forward();
        }

        setTimeout("preventBack()", 0);
        window.onunload = function () { null };
    </script>
    <form id="testForm" action="{{ route('wordtest.index', ['tagId' => $tagId, 'answer' => $answer, 'word' => $test['original']->word]) }}" method="POST" class="test-container">
        @csrf
        <div class="head">
            {{ $test["original"]->word }}
        </div>
        <div class="answer-container">
            @foreach ($test["variants"] as $variant)
            <div class="asnwer">
                <input type="radio" name="otv" value="{{ $variant->word == $test['translate']->word ? 1 : 0 }}" />
                <span>{{ $variant->word }}</span>
            </div>
            @endforeach
            <div class="center-container">
                <button type="submit" class="submit-button">
                    Ответить
                </button>
            </div>
        </div>
    </form>
@endsection
