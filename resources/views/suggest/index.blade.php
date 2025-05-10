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
            <form action="{{ route('suggest.delete', $word->id) }}" method="POST" onsubmit="return validateDelete()">
                @csrf
                @method('DELETE')
                <button type="submit" style="font-size: 25pt">🗑</button>
            </form>
        </td>
        <td>
            <form action="{{ route('suggest.approved', $word->id) }}" method="POST" onsubmit="return validateApprove()">
                @csrf
                @method('PATCH')
                <button type="submit" style="font-size: 25pt">✔</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection

@section('script')
function validateDelete() {
    if(confirm('Вы хотите удалить слово?')) {
        return true
    } else {
        return false
    }
}
function validateApprove() {
    if(confirm('Вы хотите одобрить слово?')) {
        return true
    } else {
        return false
    }
}
@endsection
