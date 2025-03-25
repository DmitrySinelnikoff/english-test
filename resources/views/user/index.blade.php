@extends('layouts.dashboard')

@section('title')
    Все пользователи
@endsection

@section('content')
    @foreach ($users as $user)
        <div class="word-container">
            <a href="{{ route('user.show', ['user' => $user]) }}">
                <div class="word-card">
                    <span>
                        {{ $user->name }}
                    </span>
                </div>
            </a>
        </div>
    @endforeach
    <div>
        {{ $users->links('pagination::bootstrap-4') }}
    </div>
    {{-- <div class="submit-button">
        <a href="{{ route('word.edit', ['word' => $word]) }}">+</a>
    </div> --}}
    @if(auth()->check() && Auth::user()->user_role_id == 2)
        <a class="add-button" href="#">+</a>
    @endif
@endsection
