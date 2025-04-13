@extends('layouts.dashboard')

@section('title')
    Регистрация
@endsection

@section('content')
    <div class="substrate">
        <form method="POST" class="auth-form" action="{{ route('register') }}" enctype="multipart/form-data">
            @csrf
            <label for="name">Имя</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
            @error('name')
                <div>{{ $message }}</div>
            @enderror

            <label for="email">Почта</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email">
            @error('email')
                <div>{{ $message }}</div>
            @enderror

            <label for="avatar">Аватар</label>
            <input id="avatar" type="file" name="avatar" value="{{ old('avatar') }}">
            @error('avatar')
                <div>{{ $message }}</div>
            @enderror

            <label for="password">Пароль</label>
            <input id="password" type="password" name="password" required autocomplete="new-password">
            @error('password')
                <div>{{ $message }}</div>
            @enderror

            <label for="password-confirm">Подтвердите пароль</label>
            <input id="password-confirm" type="password" name="password_confirmation" required autocomplete="new-password">
            @error('password-confirm')
                <div>{{ $message }}</div>
            @enderror

            <div class="center-container">
                <button type="submit" class="submit-button">Регистрация</button>
            </div>
            <div class="center-container">
                <a href="{{ route('login') }}">Авторизация</a>
            </div>
        </form>
    </div>
@endsection
