@extends('layouts.dashboard')

@section('title')
    Все слова
@endsection

@section('content')
    <form action="{{ route('word.index') }}" method="GET">
        <div class="toolbar-sorter">
            <span>По дате</span>
            <select name="sorter" id="sorter" class="sorter-options" style="width:150px; " data-role="sorter">
                <option value='old'>Старые</option>
                <option value='new'>Новые</option>
            </select>
            <button type="submit">Сортировать</button>
        </div>
    </form>
    @foreach ($words as $word)
        <div class="word-container">
            <a href="{{ route('word.show', ['word' => $word]) }}">
                <div class="word-card">
                    <span>
                        {{ $word->word }}
                    </span>
                    <br>
                    <span>
                        {{ \Illuminate\Support\Str::limit($word->translate->first()->word, 10) }}
                    </span>
                </div>
            </a>
        </div>
    @endforeach
    <div>
        {{ $words->links('pagination::bootstrap-4') }}
    </div>
    @if(auth()->check() && Auth::user()->user_role_id == 2)
        <a class="add-button" href="{{ route('word.create') }}">+</a>
    @endif
@endsection
