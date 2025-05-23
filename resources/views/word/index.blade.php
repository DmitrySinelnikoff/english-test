@extends('layouts.dashboard')

@section('title')
    Все слова
@endsection

@section('content')
    <form action="{{ route('word.index') }}" method="GET" class="sort-menu">
        <span>По дате добавления</span>
        <select name="time" id="sorter" class="sorter-options" style="width:150px; " data-role="sorter">
            <option value='old' {{ 'old' == request('time')?'selected':'' }}>Старые</option>
            <option value='new' {{ 'new' == request('time')?'selected':'' }}>Новые</option>
        </select>
        <span>Буква</span>
        <select name="letter" id="letter" class="sorter-options" style="width:150px; " data-role="sorter">
            <option disabled selected value>Буквы</option>
            @foreach ($letters as $letter)
                <option value='{{ $letter->name }}' {{ $letter->value == request('letter')?'selected':'' }}>{{ $letter->value }}</option>
            @endforeach
        </select>
        <button type="submit">Сортировать</button>
    </form>
    <div class="cards-container">
        @foreach ($words as $word)
                <a href="{{ route('word.show', ['word' => $word]) }}">
                    <div class="card">
                        <div class="image-container">
                            <img src="{{ asset('img/words/' . ($word->englishRussian->first()->image_path ?? 'word-pattern.jpg')) }}" alt="Изображение не найдено">
                        </div>
                        <div class="text-string">
                            {{ \Illuminate\Support\Str::limit($word->word, 25) }}
                        </div>
                        <div class="text-string">
                            {{ \Illuminate\Support\Str::limit($word->translate->first()->word ?? '', 25) }}
                        </div>
                    </div>
                </a>
        @endforeach
    </div>
    <div>
        {{ $words->links('pagination::bootstrap-4') }}
    </div>
    @if(auth()->check() && Auth::user()->user_role_id == 2)
        <a class="add-button" href="{{ route('word.create') }}">+</a>
    @endif
@endsection
