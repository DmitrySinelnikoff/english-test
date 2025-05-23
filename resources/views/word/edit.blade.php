@extends('layouts.dashboard')

@section('title')
    Создание слова
@endsection

@section('content')
<div class="substrate">
    <div class="center-container">
        <h1>Изменение слова</h1>
    </div>
    <form action="{{ route('word.update', $word) }}" method="post" class="auth-form" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <label for="word">Слово</label>
        <input type="text" name="word" id="word" value="{{ $word->word }}">
        @error('word')
            <div>{{ $message }}</div>
        @enderror
        <label for="transcription">Транскрипция</label>
        <input type="text" name="transcription" id="transcription" value="{{ $word->transcription }}">
        @error('transcription')
            <div>{{ $message }}</div>
        @enderror
        <label>Категории</label>
        <select name="tag_ids[]" class="select2" id="tags-select" multiple>
            @foreach ($tags as $tag)
                @if($tag->words->count() > 0)
                    <option value="{{ $tag->id }}" {{ $selectedTagsId->contains($tag->id) ? 'selected' : '' }}>{{ $tag->name }}</option>
                @endif
            @endforeach
        </select>
        @error('translate_id')
            <div>{{ $message }}</div>
        @enderror
        <div class="center-container">
            <button type="submit" class="submit-button">Изменить</button>   
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