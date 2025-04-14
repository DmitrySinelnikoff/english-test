@extends('layouts.dashboard')

@section('title')
    Создание слова
@endsection

@section('content')
<div class="substrate">
    <div class="center-container">
        <h1>Создание слова</h1>
    </div>
    <form action="{{ route('word.store') }}" class="auth-form" method="post">
        @csrf
        <label>Английское слово</label>
        <input type="text" name="word" value="{{ old('word') }}" required><br>
        @error('word')
            <div>{{ $message }}</div>
        @enderror

        <label>Транскрипция</label>
        <input type="text" name="transcription" value="{{ old('transcription') }}" required><br>
        @error('transcription')
            <div>{{ $message }}</div>
        @enderror

        <label>Теги</label>
        <select name="tag_ids[]" class="select2" id="tags-select" multiple required></select><br>
        @error('tag_ids')
            <div>{{ $message }}</div>
        @enderror

        <label>Перевод</label>
        <select name="translate_id" class="select2" id="translate-select" required></select><br>
        @error('translate_id')
            <div>{{ $message }}</div>
        @enderror

        <label>Часть речи</label>
        <select name="part_of_speech_id" class="select2" id="part-of-speech-select" required></select><br>
        @error('translate_id')
            <div>{{ $message }}</div>
        @enderror

        <div class="center-container">
            <button type="submit" class="submit-button">Добавить</button>
        </div>
    </form>
</div>
@endsection

@section('script')
$('#tags-select').select2({
    ajax: {
        url: `${location.protocol}//${location.host}/api/tags`,
        dataType: 'json', // Ожидаемый формат данных
        delay: 250, // Задержка перед отправкой запроса (в миллисекундах)
        data: function (params) {
            
            return {
                q: params.term || '', // Поисковый запрос (если есть)
                page: params.page || 1 // Номер страницы (если используется пагинация)
            };
        },
        processResults: function (data, params) {
            return {
                results: data.map(item => ({
                    id: item.id,
                    text: item.name
                })),
                pagination: {
                    more: false
                }
            };
        },
        cache: true // Кэширование результатов
    },
    placeholder: 'Выберите категорию...', // Текст-заполнитель
    minimumInputLength: 0, // Минимальное количество символов для поиска
});

$('#translate-select').select2({
    ajax: {
        url: `${location.protocol}//${location.host}/api/russian/words`,
        dataType: 'json', // Ожидаемый формат данных
        delay: 250, // Задержка перед отправкой запроса (в миллисекундах)
        data: function (params) {
            
            return {
                q: params.term || '', // Поисковый запрос (если есть)
                page: params.page || 1 // Номер страницы (если используется пагинация)
            };
        },
        processResults: function (data, params) {
            return {
                results: data.map(item => ({
                    id: item.id,
                    text: item.word
                })),
                pagination: {
                    more: false
                }
            };
        },
        cache: true // Кэширование результатов
    },
    placeholder: 'Выберите перевод...', // Текст-заполнитель
    minimumInputLength: 0, // Минимальное количество символов для поиска
}); 

$('#part-of-speech-select').select2({
    ajax: {
        url: `${location.protocol}//${location.host}/api/parts/of/speech`,
        dataType: 'json', // Ожидаемый формат данных
        delay: 250, // Задержка перед отправкой запроса (в миллисекундах)
        data: function (params) {
            
            return {
                q: params.term || '', // Поисковый запрос (если есть)
                page: params.page || 1 // Номер страницы (если используется пагинация)
            };
        },
        processResults: function (data, params) {
            return {
                results: data.map(item => ({
                    id: item.id,
                    text: item.name
                })),
                pagination: {
                    more: false
                }
            };
        },
        cache: true // Кэширование результатов
    },
    placeholder: 'Выберите часть речи...', // Текст-заполнитель
    minimumInputLength: 0, // Минимальное количество символов для поиска
}); 
@endsection
