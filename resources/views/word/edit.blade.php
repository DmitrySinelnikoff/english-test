@extends('layouts.dashboard')

@section('title')
    Создание слова
@endsection

@section('content')
<div class="substrate">
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
        <select name="tag_ids[]" class="select2" multiple>
            @foreach ($tags as $tag)
                @if($tag->words->count() > 0)
                    <option value="{{ $tag->id }}" {{ $selectedTagsId->contains($tag->id) ? 'selected' : '' }}>{{ $tag->name }}</option>
                @endif
            @endforeach
        </select>
        <label>Перевод</label>
        <select name="translate_id" class="select2" multiple>
            @foreach ($russianWords->chunk(50) as $words)
                @foreach ($words as $word)
                    <option value="{{ $word->id }}" {{ $selectedWordsId->contains($word->id) ? 'selected' : '' }}>{{ $word->word }}</option>
                @endforeach
            @endforeach
        </select>
        <div class="center-container">
            <button type="submit" class="submit-button">Изменить</button>   
        </div>
    </form>
</div>

<script>

</script>
@endsection
