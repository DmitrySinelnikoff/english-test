@extends('layouts.dashboard')

@section('title')
    Все категории тестов
@endsection

@section('content')
    @foreach ($tags as $tag)
        <div class="word-container">
            <a href="{{ route('tags.show', ['tag' => $tag]) }}">
                <div class="word-card">
                    <span>
                        {{ $tag->name }}
                    </span>
                    <br>
                    <span>
                        {{ $tag->words->count() }}
                    </span>
                </div>
            </a>
        </div>
    @endforeach
    <div>
        {{ $tags->links('pagination::bootstrap-4') }}
    </div>
    @if(auth()->check() && Auth::user()->user_role_id == 2)
        <a class="add-button" href="{{ route('tags.create') }}">+</a>
    @endif
@endsection
