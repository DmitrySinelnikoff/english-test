@extends('layouts.dashboard')

@section('title')
    Тест
@endsection

@section('content')

<form id="testForm" action="{{ route("wordtest.check", ["question" => $result["question"], "thisQuestionPage" => $result["thisQuestionPage"], "testID" => $result["testID"]]) }}" method="POST" class="test-container">
    @csrf  
    <div class="head">
        {{ $result["thisQuestionPage"] }} - 
        @if($result["testType"] == 1)
            {{ $result["englishWord"] }}
        @else
            {{ $result["russianWord"] }}
        @endif
        @if($result["question"]->result == 2)
            🟢
        @elseif($result["question"]->result == 1)
            🔴
        @else
            🔵
        @endif
    </div>
    <div class="answer-container">
        @foreach ($result["variants"] as $key => $variant)
            <div class="asnwer">
                <input type="radio" name="otv" id="otv-{{$key}}" value="{{ $key == $result["trueVariantPosition"] ? 1 : 0 }}" />
                <label for="otv-{{$key}}">{{ $variant }}</span>
            </div>
        @endforeach 
        <div class="center-container">
            @if($result['thisQuestionPage'] > 1)
                <a class="navigate-button white-text" href="/wordtest/show/{{$result['testID']}}/{{$result['thisQuestionPage'] - 1}}"><</a>
            @endif
            <button type="submit" class="submit-button" {{ $result['question']->result != 0 ? "disabled" : 0 }}>
                Ответить
            </button>
            @if($result['thisQuestionPage'] < 10)
                <a class="navigate-button white-text" href="/wordtest/show/{{$result['testID']}}/{{$result['thisQuestionPage'] + 1}}">></a>
            @endif
        </div>
        
        <div class="center-container">
            @foreach($result["allQuestions"] as $key => $question)
                <a href="{{ route("wordtest.show", ["test" => $result["testID"], "index" => ++$key]) }}" class="question-number
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
        <div class="center-container">
            @if($result["testStatus"] == 1)
                <a class="submit-button" style="color: black" href="{{ route("wordtest.result", ["test" => $result['testID']]) }}">Результаты</a>
            @endif
        </div>
    </div>
</form>

@endsection
