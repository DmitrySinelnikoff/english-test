@extends('layouts.dashboard')

@section('title')
    Создание слова
@endsection

@section('content')
<div class="substrate">
    <form action="{{ route('russian.word.update', $word) }}" method="post" class="auth-form">
        @csrf
        @method('PATCH')
        <label for="word">Слово</label>
        <input type="text" name="word" id="word" value="{{ $word->word }}">
        @error('word')
            <div>{{ $message }}</div>
        @enderror
        <div class="center-container">
            <button type="submit" class="submit-button">Изменить</button>   
        </div>
    </form>
</div>
@endsection
