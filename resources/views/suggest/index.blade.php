@extends('layouts.dashboard')

@section('title')
    Предложить слово
@endsection

@section('content')
<table class="table">
    <tr>
        <th>Слово</th>
        <th>Транскрипция</th>
        <th>Тег</th>
        <th>Перевод</th>
        <th>Удалить</th>
        <th>Изменить</th>
        <th>Одобрить</th>
    </tr>
    @foreach ($data as $word)
    <tr>
        <td><a href="{{ route('word.show', ['word' => $word]) }}">{{ $word->word }}</a></td>
        <td>{{ $word->transcription }}</td>
        <td>
            @foreach ($word->tag as $tag)
                <a href="{{ route('tags.show', ['tag' => $tag]) }}">{{ $tag->name }}</a> <br>
            @endforeach
        </td>
        <td>
            @foreach ($word->translate as $translate)
                {{ $translate->word }}
            @endforeach
        </td>
        <td>
            <form action="{{ route('suggest.delete', $word->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" style="font-size: 25pt">🗑</button>
            </form>
        </td>
        <td><a href="#">✏️</a></td>
        <td>
            <form action="{{ route('suggest.approved', $word->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <button type="submit" style="font-size: 25pt">✔</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection
