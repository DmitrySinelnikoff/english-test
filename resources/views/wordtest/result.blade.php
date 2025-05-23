@extends('layouts.dashboard')

@section('title')
    Результат
@endsection

@section('content')
<div class="print">
    <div class="test-container">
        <div class="head">Баллы: {{ $trueAnswerCount }}</div>
        <div class="answer-container">
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
                        <td>
                            <a href="{{ route('word.show', ['word' => $result->wordCombination->englishWord]) }}">
                                {{ $result->wordCombination->englishWord->word }}
                            </a>
                        </td>
                        <td>{{ $result->wordCombination->russianWord->word }}</td>
                        <td class="{{ $result->result == 2 ? 'asnwer-right' : 'asnwer-wrong' }}">{{ $result->result == 2 ? 'Правильно' : 'Неправильно' }}</td>
                    </tr>
                @endforeach
            </table>
            <div class="center-container">
                <input class="submit-button" type="button" value="Напечатать результат" onClick="window.print()" />
            </div>
        </div>
    </div>
</div>
<div class="substrate">
    <h1>Дата окончания теста: {{ $endDate->updated_at }}</h1>
</div>

@endsection
