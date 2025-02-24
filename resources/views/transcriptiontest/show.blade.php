@extends('layouts.dashboard')

@section('title')
    Тест
@endsection

@section('content')

<form id="testForm" action="{{ route("wordtest.check", ["question" => $result["question"], "thisQuestionPage" => $result["thisQuestionPage"], "testID" => $result["testID"]]) }}" method="POST" class="testContainer">
    @csrf  
    <div class="head">
        {{ $result["thisQuestionPage"] }} - {{ $result["englishWord"] }}
        @if($result["question"]->result == 2)
            🟢
        @elseif($result["question"]->result == 1)
            🔴
        @else
            🔵
        @endif
    </div>
    <div class="answerContainer">
        <div class="centerContainer">
            @foreach($result["allQuestions"] as $key => $question)
                <a href="{{ route("wordtest.show", ["test" => $result["testID"], "index" => ++$key]) }}" class="questionNumber
                    @if($question->result == 2)
                        green
                    @elseif($question->result == 1)
                        red
                    @else
                        blue
                    @endif">
                    {{ $key }}
                </a>    
            @endforeach
        </div>
        <div class="centerContainer">
            @if($result["testStatus"] == 1)
                <a class="submitButton" style="color: black" href="{{ route("wordtest.result", ["test" => $result['testID']]) }}">Результаты</a>
            @endif
        </div>
    </div>
</form>

@endsection
