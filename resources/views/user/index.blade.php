@extends('layouts.dashboard')

@section('title')
    Все пользователи
@endsection

@section('content')
    <div class="cards-container">
        @foreach ($users as $user)
            <a href="{{ route('user.show', ['user' => $user]) }}">
                <div class="card">
                    <img
                        src="{{ asset('img/avatars/' . ($user->image_path ?? 'unknown_avatar.jpg')) }}"
                        alt="Аватар не найден" class="avatar-img"
                    >
                    <div class="text-string">
                        {{ \Illuminate\Support\Str::limit($user->name, 10) }}
                    </div>
                    <div class="text-string">
                        {{ $user->user_role_id == 1 ? 'Пользователь' : 'Администратор' }}
                    </div>
                </div>
            </a>
        @endforeach
    </div>
    <div>
        {{ $users->links('pagination::bootstrap-4') }}
    </div>
@endsection
