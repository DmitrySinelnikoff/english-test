@extends('layouts.dashboard')

@section('title')
    Все теги
@endsection

@section('content')
    @foreach ($tags as $tag)
        <div class="wordContainer">
            @if ($tag->words->count() > 0)
            <a href="{{ route('tags.show', ['tag' => $tag]) }}">
                <div class="wordCard">
                    <span>
                        {{ $tag->name }}
                    </span>
                    <br>
                    <span>
                        {{ $tag->words->count() }}
                    </span>
                </div>
            </a>
            @endif
        </div>
    @endforeach
    <div>
        {{ $tags->links('pagination::bootstrap-4') }}
    </div>
@endsection
