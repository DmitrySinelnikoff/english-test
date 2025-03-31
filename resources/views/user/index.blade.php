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
                        {{ \Illuminate\Support\Str::limit($user->name, 10) }}
                    </span><br>
                    <span>
                        {{ $user->user_role_id == 1 ? 'Пользователь' : 'Администратор' }}
                    </span>
                </div>
            </a>
        </div>
    @endforeach
    <div>
        {{ $users->links('pagination::bootstrap-4') }}
    </div>
@endsection
