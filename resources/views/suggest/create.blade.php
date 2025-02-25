@extends('layouts.dashboard')

@section('title')
    Предложить слово
@endsection

@section('content')
<div class="substrate">
    <form action="{{ route('suggest.store') }}" class="auth-form" method="post">
        @csrf

        <label>Английское слово</label>
        <input type="text" name="word" value="{{ old('word') }}"><br>
        @error('word')
            <div>{{ $message }}</div>
        @enderror

        <label>Транскрипция</label>
        <input type="text" name="transcription" value="{{ old('transcription') }}"><br>
        @error('transcription')
            <div>{{ $message }}</div>
        @enderror

        <label>Теги</label>
        <select name="tag_ids[]" class="select2" multiple>
            @foreach ($tags as $tag)
                @if($tag->words->count() > 0)
                    <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                @endif
            @endforeach
        </select><br>
        @error('tag_ids')
            <div>{{ $message }}</div>
        @enderror

        <label>Перевод</label>
        <select name="translate_id" class="select2">
            <option disabled selected value>---------</option>
            @foreach ($russianWords->chunk(50) as $words)
                @foreach ($words as $word)
                    <option value="{{ $word->id }}">{{ $word->word }}</option>
                @endforeach
            @endforeach
        </select><br>
        @error('translate_id')
            <div>{{ $message }}</div>
        @enderror
        <div class="center-container">
            <button type="submit" class="submit-button">Отправить</button>
        </div>
    </form>
</div>

@endsection
