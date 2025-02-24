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
    <form id="testForm" action="{{ route('wordtest.index', ['tagId' => $tagId, 'answer' => $answer, 'word' => $test['original']->word]) }}" method="POST" class="testContainer">
        @csrf
        <div class="head">
            {{ $test["original"]->word }}
        </div>
        <div class="answerContainer">
            @foreach ($test["variants"] as $variant)
            <div class="asnwer">
                <input type="radio" name="otv" value="{{ $variant->word == $test['translate']->word ? 1 : 0 }}" />
                <span>{{ $variant->word }}</span>
            </div>
            @endforeach
            <div class="centerContainer">
                <button type="submit" class="submitButton">
                    Ответить
                </button>
            </div>
        </div>
    </form>
@endsection
