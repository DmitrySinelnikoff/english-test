@extends('layouts.dashboard')

@section('title')
    Создание слова
@endsection

@section('content')
<div class="substrate">
    <form action="" method="post" class="auth-form">
        <label for="word">Слово</label>
        <input type="text" name="word" id="word" value="{{ old('word') }}">
        <label for="transcription">Транскрипция</label>
        <input type="text" name="transcription" id="transcription" value="{{ old('transcription') }}">
    </form>
</div>
@endsection
