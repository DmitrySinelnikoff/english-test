@extends('layouts.dashboard')

@section('title')
    Создание слова
@endsection

@section('content')
<div class="substrate">
    <div class="center-container">
        <h1>Изменение слова</h1>
    </div>
    <form action="" method="post" class="auth-form">
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
        <label>Теги</label>
        <select name="tag_ids[]" class="select2" id="tags-select" multiple>
            @foreach ($tags as $tag)
                @if($tag->words->count() > 0)
                    <option value="{{ $tag->id }}" {{ $selectedTagsId->contains($tag->id) ? 'selected' : '' }}>{{ $tag->name }}</option>
                @endif
            @endforeach
        </select>
        <label>Перевод</label>
        <select name="translate_id" class="select2" id="translate-select" multiple>
            @foreach ($russianWords->chunk(50) as $words)
                @foreach ($words as $word)
                    <option value="{{ $word->id }}" {{ $selectedWordsId->contains($word->id) ? 'selected' : '' }}>{{ $word->word }}</option>
                @endforeach
            @endforeach
        </select>
        <label>Часть речи</label>
        <select name="part_of_speech_id" class="select2" id="part-of-speech-select" required>
            @foreach ($partsOfSpeech as $partOfSpeech)
                <option value="{{ $partOfSpeech->id }}" {{ $selectSpeechId->contains($partOfSpeech->id) ? 'selected' : '' }}>{{ $partOfSpeech->name }}</option>
            @endforeach
        </select><br>
        @error('translate_id')
            <div>{{ $message }}</div>
        @enderror
        <label for="image">Изображение</label>
        <div class="center-container">
            <label>Текущее:</label>
            <img src="{{ asset('img/words/' . ($word->image_path ?? 'word-pattern.jpg')) }}" alt="Аватар не найден" class="avatar-img-edit" width="100px" height="100px">
        </div>  
        <input id="image" type="file" name="image" value="{{ old('image') }}">
        @error('image')
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