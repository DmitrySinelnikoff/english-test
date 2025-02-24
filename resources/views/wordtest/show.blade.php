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
        @foreach ($result["variants"] as $key => $variant)
            <div class="asnwer">
                <input type="radio" name="otv" id="otv-{{$key}}" value="{{ $key == $result["trueVariantPosition"] ? 1 : 0 }}" />
                <label for="otv-{{$key}}">{{ $variant }}</span>
            </div>
        @endforeach 
        <div class="centerContainer">
            @if($result['thisQuestionPage'] > 1)
                <a class="navigateButton" href="/wordtest/show/{{$result['testID']}}/{{$result['thisQuestionPage'] - 1}}"><</a>
            @endif
            <button type="submit" class="submitButton" {{ $result['question']->result != 0 ? "disabled" : 0 }}>
                Ответить
            </button>
            @if($result['thisQuestionPage'] < 10)
                <a class="navigateButton" href="/wordtest/show/{{$result['testID']}}/{{$result['thisQuestionPage'] + 1}}">></a>
            @endif
        </div>
        
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
