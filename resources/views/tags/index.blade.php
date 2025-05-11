@extends('layouts.dashboard')

@section('title')
    Все категории тестов
@endsection

@section('content')
    <div class="cards-container">
        @foreach ($tags as $tag)
            <a href="{{ route('tags.show', ['tag' => $tag]) }}">
                <div class="card">
                    <img src="{{ asset('img/tags/' . ($tag->image_path ?? 'tag-pattern.jpg')) }}" alt="Изображение не найдено">
                    <div class="text-string">
                        {{ $tag->name }}
                    </div>
                    <div class="text-string">
                        Кол-во: {{ $tag->words->count() }}
                    </div>
                </div>
            </a>
        @endforeach
    </div>
    <div>
        {{ $tags->links('pagination::bootstrap-4') }}
    </div>
    @if(auth()->check() && Auth::user()->user_role_id == 2)
        <a class="add-button" href="{{ route('tags.create') }}">+</a>
    @endif
@endsection
