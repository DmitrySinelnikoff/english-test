@extends('layouts.dashboard')

@section('title')
    Результат
@endsection

@section('content')
<div class="print">
    <div class="testContainer">
        <div class="head">Баллы: {{ $trueAnswerCount }}</div>
        <div class="answerContainer">
            <table class="table">
                <tr>
                    <th>Номер</th>
                    <th>Слово</th>
                    <th>Перевод</th>
                    <th>Ответ</th>
                </tr>
                @foreach ($results as $key => $result)
                <tr>
                    <td>{{ $key + 1}}</td>
                    <td>{{ $result->wordCombination->englishWord->word }}</td>
                    <td>{{ $result->wordCombination->russianWord->word }}</td>
                    <td class="{{ $result->result == 2 ? 'asnwerRight' : 'asnwerWrong' }}">{{ $result->result == 2 ? 'Правильно' : 'Неправильно' }}</td>
                </tr>
                @endforeach
            </table>
            <input class="submitButton" type="button" value="Напечатать результат" onClick="window.print()" />
        </div>
    </div>
</div>

@endsection
